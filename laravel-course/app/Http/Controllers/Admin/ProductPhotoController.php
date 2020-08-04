<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request)
    {
        $photoName = $request->photoName;
        // Verifica no disco 'public' se existe o arquivo salvado.
        if (Storage::disk('public')->exists($photoName)) {
            // Deleta o arquivo do disco.
            Storage::disk('public')->delete($photoName);
        }

        // Remove o arquivo (imagem) no banco de dados
        $removePhoto = ProductPhoto::where('image', $photoName);
        $productId = $removePhoto->first()->product_id;
        $removePhoto->delete();
        flash('Imagem removida com sucesso')->success();

        return redirect()->route('admin.products.edit', ['product' => $productId]);
    }
}
