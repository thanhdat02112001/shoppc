<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\EditRequest;
use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function save(CategoryRequest $request)
    {
        $formValue =
        [
            "name" => $request->name,
            "slug" => $request->slug,
            "description" => $request->description,
        ];
        if (Category::create($formValue)) {
            $request->session()->flash("success", "Cập nhật danh mục thành công!");
            return redirect("/admin/categories");
        } else {
            $request->session()->flash("error", "Đã xảy ra lỗi!");
            return redirect("/admin/categories");
        }
    }

    public function show()
    {
        $categories = Category::all();
        return view("backend.category", compact('categories'));
    }

    public function edit($id)
    {
        $categories = Category::all()->except($id);
        $category = Category::find($id);
        return view("backend.editcategory", compact('category', 'categories'));
    }

    public function update($id, EditRequest $request)
    {
        $category = Category::find($id);
        if ($category->update($request->all())) {
            $request->session()->flash("success", "Đã cap nhat danh mục thành công!");
            return redirect("/admin/categories");
        } else {
            $request->session()->flash("error", "Đã xảy ra lỗi!");
            return redirect("/admin/categories");
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categoryHome');
    }
}
