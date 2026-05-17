import axios from 'axios';
// Jodit Editor
import 'jodit/esm/plugins/resizer/resizer'; // Resizer plugin is used when inserting images
import 'jodit/esm/plugins/video/video'; // Video plugin is used to insert videos
// Feel free to add extra plugins here...
import { Jodit } from 'jodit';
window.Jodit = Jodit;

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
