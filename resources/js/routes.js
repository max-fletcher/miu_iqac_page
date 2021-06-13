import Home from "./components/home";
import About from "./components/about";
import NotFound from "./components/notfound";

export default{
   mode: 'history',

   routes: [
      {
         path: '*',
         title: "Not Found",
         component: NotFound,
         meta: { title: '404 Not Found' }
      },
      {
         path: '/',
         component: Home,
         meta: { title: 'Home' }
      },
      {
         path: '/about',
         component: About,
         meta: { title: 'About Us' }
      },
   ]
}