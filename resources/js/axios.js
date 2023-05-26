// axios.js

import axios from "axios";

// Set the base URL for your Laravel API
axios.defaults.baseURL = env('APP_URL');

// Optionally, you can set default headers or intercept requests and responses
// axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
// axios.interceptors.request.use(...);
// axios.interceptors.response.use(...);

export default axios;
