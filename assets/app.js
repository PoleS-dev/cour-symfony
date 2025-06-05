import { registerVueControllerComponents } from '@symfony/ux-vue';
import './bootstrap.js';
import './script/home.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import './styles/home.css';


// 👇 Importmap via AssetMapper oblige à importer explicitement
registerVueControllerComponents(
    require.context('./vue', true, /\.vue$/)
);