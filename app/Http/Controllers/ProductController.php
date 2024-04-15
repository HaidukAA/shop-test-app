<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Метод для отображения списка товаров
    public function index()
    {
        // Получаем список всех товаров
        $products = Product::all();
                
        // Получаем текущего пользователя
        $user = Auth::user();

        // Передаем список товаров и пользователя в представление
        return view('products.index', ['products' => $products, 'user' => $user]);
    }

    // Метод для отображения страницы создания товара
    public function create()
    {
        return view('products.create');
    }

    // Метод для сохранения нового товара в базе данных
    // Метод для сохранения нового товара в базе данных
    public function store(Request $request)
    {
        // Валидация входящих данных
        $validatedData = $request->validate([
            'article' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'slug' => 'required|string',
        ]);

        // Создание нового товара
        $product = new Product();
        $product->fill($validatedData);

        // Присваиваем id пользователя, который создал товар
        $product->user_id = Auth::id();

        // Сохранение товара в базе данных
        $product->save();

        // Редирект на страницу списка товаров с сообщением об успехе
        return redirect()->route('products.index')->with('success', 'Товар успешно добавлен');
    }

    // Метод для отображения страницы редактирования товара
    public function edit(Product $product)
    {
        $this->authorize('edit', $product);

        return view('products.edit', ['product' => $product]);
    }

    // Метод для отображения информации о товаре
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }

    public function update(Request $request, Product $product)
    {        
        // Проверяем разрешение на редактирование товара
        $this->authorize('update', $product);
        // Проверка разрешения на редактирование товара
        if (Auth::user()->can('update', $product)) {
            $request->validate([
                'article' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'slug' => 'nullable|string',
            ]);

            $product->update($request->all());

            return redirect()->route('products.index')->with('success', 'Товар успешно обновлен');
        } else {
            return redirect()->route('products.index')->with('error', 'У вас нет разрешения на редактирование этого товара');
        }
    }

    // Метод для удаления товара из базы данных
    public function destroy(Product $product)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Вы не авторизованы');
        }

        if ($user->isAdmin() || $user->id === $product->user_id) {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Товар успешно удален');
        }

        return redirect()->route('products.index')->with('error', 'Вы не имеете прав для удаления этого товара');
    }
}
