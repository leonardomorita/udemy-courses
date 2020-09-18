<?php

// Precisa ser estudado novamente

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadTrait {
    private function imageUpload($images, $imageColumn = null)
    {
        // Este array vai conter os nomes do caminho da imagem
        $uploadedImages = [];
        // Verificação se a imagem é da loja ou produto, verificando se a variável 'images' é um array ou não é um array.
        if ( is_array($images) ) {
            // Caso for array, as imagens são do produto
            foreach ($images as $image) {
                // O método store() vem da referência do UploadedFile()
                // O primeiro parâmetro do store() é o nome do diretório que vai ser armazenado a imagem
                // O segundo parâmetro do store() é o nome do 'disk' que está sendo usado
                $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
            }
        } else {
            // Caso não for array, é a logo da loja
            $uploadedImages = $images->store('logo', 'public');
        }

        return $uploadedImages;
    }
}
