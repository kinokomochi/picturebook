<?php
//開発用
const URL_SCHEME = 'http';
const URL_HOST = 'localhost';
const URL_PATH = '/pbook';

//本番用
//const URL_SCHEME = 'https';
// const URL_HOST = 'www.picturebook.com';
// const URL_PATH = '/';

//共通
const URL_ROOT = URL_SCHEME.'://'. URL_HOST.URL_PATH.'/';
const COOKIE_PATH = URL_PATH;
const COOKIE_DOMAIN = URL_HOST;

//開発用
const IMAGE_DIR = '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/';