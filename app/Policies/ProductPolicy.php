<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    /**
     * Determine whether the user can view any products.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true; // Любой пользователь может просматривать все товары
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return true; // Любой пользователь может просматривать любой товар
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->exists; // Только авторизованный пользователь может создавать товары
    }

    public function edit(User $user, Product $product)
    {
        
        
        if ($user->isAdmin()) {
           
            return true;
        }

        // Если пользователь не администратор, проверяем, является ли он автором товара
        if ($user->id === $product->user_id) {
          
            return true; // Пользователь может редактировать свой товар
        }

        return false; // Пользователь не может редактировать товар
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        // Если пользователь администратор, то он может редактировать любой товар
        if ($user->isAdmin()) {
            return true;
        }

        // Если пользователь не администратор, проверяем, является ли он автором товара
        if ($user->id === $product->user_id) {
            return true; // Пользователь может редактировать свой товар
        }

        return false; // Пользователь не может редактировать товар
    }


    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return $user->isAdmin(); // Только администратор может удалять товары
    }
}
