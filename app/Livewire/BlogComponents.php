<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\User;
use App\Models\Blog;

#[Title('Blogs')]
class BlogComponents extends Component
{
    use WithFileUploads;

    public $bloges, $title, $description, $photo , $blog_id;
    public $updateMode = false;

    public function render()
    {
        $this->bloges = Blog::all();
        return view('livewire.blog-components');
    }

    private function resetInputFields(){
        $this->title = '';
        $this->description = '';
        $this->photo = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'image|max:1024',
        ]);

        $photoPath = $this->photo->store('photos', 'public');

        Blog::create([
            'title' => $this->title,
            'description' => $this->description,
            'photo' => $photoPath, 
        ]);

        session()->flash('message', 'Blog Created Successfully.');
        $this->resetInputFields();
        return $this->redirectRoute('blog', navigate: true);
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $this->blog_id = $id;
        $this->title = $blog->title;
        $this->description = $blog->description;
        $this->photo = $blog->photo;
        $this->updateMode = true;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'image|max:1024|nullable',
        ]);

        
        $blog = Blog::find($this->blog_id);
        $blog->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        if ($this->photo) {
            // Delete the old photo if it exists
            if ($blog->photo) 
            {
                Storage::disk('public')->delete($blog->photo);
            }
    
            $photoPath = $this->photo->store('photos', 'public');
            $blog->update(['photo' => $photoPath]);
        }
    
        $this->updateMode = false;
        session()->flash('message', 'Blog Updated Successfully.');

        $this->resetInputFields();

        return $this->redirectRoute('blog', navigate: true);
    }

    public function delete($id)
    {
        Blog::find($id)->delete();
        session()->flash('message', 'Blog Deleted Successfully.');
        return $this->redirectRoute('blog', navigate: true);
    }

    public function download($id)
    {
        $blog = Blog::findOrFail($id);

        return Storage::disk('public')->download($blog->photo);
    }
}
