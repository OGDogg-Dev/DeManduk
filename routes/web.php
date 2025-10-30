<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/profil', 'pages.profile')->name('profile');
Route::view('/fasilitas-harga', 'pages.fasilitas-harga')->name('fasilitas.harga');
Route::view('/jam-operasional', 'pages.jam')->name('jam');
Route::view('/peta', 'pages.peta')->name('peta');
Route::view('/galeri', 'pages.galeri')->name('galeri');

Route::view('/event', 'pages.event-index')->name('event.index');
Route::view('/event/{slug}', 'pages.event-show')->name('event.show');

Route::view('/blog', 'pages.blog.index')->name('blog.index');
Route::view('/blog/{slug}', 'pages.blog.show')->name('blog.show');

Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/kontak', 'pages.kontak')->name('kontak');
Route::view('/qris', 'pages.qris')->name('qris');
