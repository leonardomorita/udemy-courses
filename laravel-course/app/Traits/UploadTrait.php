<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadTrait {
    private function imageUpload($images, $imageColumn = null)
    {
        $uploadedImages = [];
        // Verificação se a imagem é da loja ou produto, verificando se a variável 'images' é um array ou não é um array.
        if (is_array($images)) {
            // Caso for array, as imagens são do produto
            foreach ($images as $image) {
                $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
            }
        } else {
            // Caso não for array, é a logo da loja
            $uploadedImages = $images->store('logo', 'public');
        }

        return $uploadedImages;
    }
}
