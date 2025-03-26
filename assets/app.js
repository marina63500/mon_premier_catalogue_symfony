import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

// Je prends le JS de Bootstrap
import 'bootstrap';


// Je prends le CSS de Bootstrap
import './vendor/bootstrap/dist/css/bootstrap.min.css';



//  c'est mon css
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
