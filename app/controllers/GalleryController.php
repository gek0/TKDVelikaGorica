<?php

class GalleryController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show admin gallery
     * @return mixed
     */
    public function showImageGalleries()
    {
        $image_gallery_data = Gallery::orderBy('id', 'DESC')->get();

        return View::make('admin.image-gallery.index')->with(['page_title' => 'Administracija',
                                                        'image_gallery_data' => $image_gallery_data
        ]);
    }

    /**
     * create image gallery
     * @return mixed
     */
    public function createImageGallery()
    {
        $gallery_name = ['name' => e(Input::get('name'))];
        $gallery_images = Input::file('image_gallery_images');
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token');
        }

        //validate
        $error_list = null;

        $validator_gallery = Validator::make($gallery_name, GalleryImage::$rules, GalleryImage::$messages);
        if($validator_gallery->fails()){
            $error_list = $validator_gallery->messages()->merge();
        }

        if($gallery_images == true){
            foreach($gallery_images as $img){
                $validator_images = Validator::make(['images' => $img], GalleryImage::$rules, GalleryImage::$messages);
                if($validator_images->fails()){
                    $error_list = $validator_images->messages()->merge();
                }
            }
        }

        //check for errors
        if($error_list == null){
            //create new gallery
            $gallery = new Gallery;
            $gallery->name = $gallery_name['name'];
            $gallery->path = Str::limit(safe_name($gallery_name['name']), 25);
            $gallery->save();

            $gallery_id = $gallery->id;

            //add new images
            if($gallery_images == true && $gallery_images[0] != null){
                //check for image directory
                $path = public_path().'/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery->path.'/';
                if(!File::exists($path)){
                    File::makeDirectory($path, 0777);
                }

                foreach($gallery_images as $img){
                    $file_name = $gallery->path.'_galerija_'.Str::random(5);
                    $file_extension = $img->getClientOriginalExtension();
                    $full_name = $file_name.'.'.$file_extension;
                    $file_size = $img->getSize();

                    $file_uploaded = $img->move($path, $full_name);
                    $image_resize = Image::make($path.$full_name)->widen(800, function ($constraint) {
                        $constraint->upsize();
                    })->save();
                    if($file_uploaded){
                        $image = new GalleryImage;
                        $image->gallery_id = $gallery_id;
                        $image->file_name = $full_name;
                        $image->file_size = $file_size;
                        $image->save();
                    }
                }


                //redirect on finish
                return Redirect::to(route('admin-image-galleries'))->with(['success' => 'Galerija uspješno napravljena']);
            }
            else{
                return Redirect::to(route('admin-image-galleries'))->withErrors('Nijedna slika nije odabrana');
            }
        }
        else{
            return Redirect::to(route('admin-image-galleries'))->withErrors($error_list);
        }
    }

    /**
     * show admin individual gallery
     * @return mixed
     */
    public function viewImageGallery($slug = null)
    {
        if ($slug !== null){
            $gallery_data = Gallery::findBySlug(e($slug));

            //check if news exists
            if($gallery_data){
                return View::make('admin.image-gallery.show')->with(['page_title' => 'Administracija',
                                                            'gallery_data' => $gallery_data
                ]);
            }
            else{
                return Redirect::to(route('admin-image-galleries'))->withErrors('Galerija ne postoji.');
            }
        }
        else{
            return Redirect::to(route('admin-image-galleries'))->withErrors('Galerija ne postoji.');
        }
    }

    /**
     * edit image gallery
     * @return mixed
     */
    public function editImageGallery()
    {
        $gallery_name = ['name' => e(Input::get('name'))];
        $gallery_id = e(Input::get('id'));
        $gallery_images = Input::file('image_gallery_images');
        $token = Input::get('_token');

        //check if csrf token is valid
        if(Session::token() != $token){
            return Redirect::back()->withErrors('Nevažeći CSRF token');
        }

        if ($gallery_id !== null){
            $gallery = Gallery::findOrFail(e($gallery_id));

            //check if news exists
            if($gallery){
                //validate
                $error_list = null;

                $validator_gallery = Validator::make($gallery_name, GalleryImage::$rules, GalleryImage::$messages);
                if($validator_gallery->fails()){
                    $error_list = $validator_gallery->messages()->merge();
                }

                if($gallery_images == true){
                    foreach($gallery_images as $img){
                        $validator_images = Validator::make(['images' => $img], GalleryImage::$rules, GalleryImage::$messages);
                        if($validator_images->fails()){
                            $error_list = $validator_images->messages()->merge();
                        }
                    }
                }

                //check for errors
                if($error_list == null){
                    $gallery->name = $gallery_name['name'];
                    $gallery->slug = string_like_slug(safe_name($gallery_name['name']));
                    $gallery->save();

                    //add new images
                    if($gallery_images == true && $gallery_images[0] != null){
                        //check for image directory
                        $path = public_path().'/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery->path.'/';
                        if(!File::exists($path)){
                            File::makeDirectory($path, 0777);
                        }

                        foreach($gallery_images as $img){
                            $file_name = $gallery->path.'_galerija_'.Str::random(5);
                            $file_extension = $img->getClientOriginalExtension();
                            $full_name = $file_name.'.'.$file_extension;
                            $file_size = $img->getSize();

                            $file_uploaded = $img->move($path, $full_name);
                            $image_resize = Image::make($path.$full_name)->widen(800, function ($constraint) {
                                $constraint->upsize();
                            })->save();
                            if($file_uploaded){
                                $image = new GalleryImage;
                                $image->gallery_id = $gallery_id;
                                $image->file_name = $full_name;
                                $image->file_size = $file_size;
                                $image->save();
                            }
                        }

                        //redirect on finish
                        return Redirect::to(route('admin-image-galleries'))->with(['success' => 'Galerija uspješno izmjenjena']);
                    }

                    //redirect on finish
                    return Redirect::to(route('admin-image-galleries'))->with(['success' => 'Galerija uspješno izmjenjena']);
                }
                else{
                    return Redirect::to(route('admin-image-galleries'))->withErrors($error_list);
                }
            }
            else{
                return Redirect::to(route('admin-image-galleries'))->withErrors('Galerija ne postoji.');
            }
        }
        else{
            return Redirect::to(route('admin-image-galleries'))->withErrors('Galerija ne postoji.');
        }
    }

    /**
     * delete image from image gallery
     * @param null $id
     * @return mixed
     */
    public function deleteImageGalleryImage($id = null)
    {
        if($id == null){
            return Redirect::back()->withErrors('Odabrana slika ne postoji');
        }
        else{
            // find image in database
            $image = GalleryImage::find(e($id));

            if($image){
                try{
                    $gallery = Gallery::findOrFail($image->gallery_id);

                    File::delete(public_path().'/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery->path.'/'.$image->file_name);
                    $image->delete();
                }
                catch(Exception $e){
                    return Redirect::back()->withErrors('Slika nije mogla biti obrisana');
                }

                //redirect on finish
                return Redirect::back()->with(['success' => 'Slika je uspješno obrisana']);
            }
            else{
                return Redirect::back()->withErrors('Odabrana slika ne postoji');
            }
        }
    }

    /**
     * delete image gallery
     * @param null $id
     * @return mixed
     */
    public function deleteImageGallery($id = null)
    {
        if($id == null){
            return Redirect::back()->withErrors('Odabrana galerija ne postoji');
        }
        else{
            // find gallery in database
            $gallery = Gallery::findOrFail(e($id));

            if($gallery){
                try{
                    File::deleteDirectory(public_path().'/'.getenv('IMAGE_GALLERY_UPLOAD_DIR').'/'.$gallery->path);
                    $gallery->delete();
                }
                catch(Exception $e){
                    return Redirect::back()->withErrors('Galerija nije mogla biti obrisana');
                }

                //redirect on finish
                return Redirect::to(route('admin-image-galleries'))->with(['success' => 'Galerija je uspješno obrisana']);
            }
            else{
                return Redirect::to(route('admin-image-galleries'))->withErrors('Odabrana galerija ne postoji');
            }
        }
    }

}