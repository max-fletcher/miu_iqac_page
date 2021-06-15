import Home from "./pages/home";
import About from "./pages/about";
import Members from "./pages/members";
import Events from "./pages/events";
import News from "./pages/news";
import Resources from "./pages/resources";
import NotFound from "./pages/notfound";
import Topnav from "./pages/components/topnav";
import Tabsnav from "./pages/components/tabsnav";

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
      {
         path: '/members',
         component: Members,
         meta: { title: 'Members' }
      },
      {
         path: '/events',
         component: Events,
         meta: { title: 'Events' }
      },
      {
         path: '/news',
         component: News,
         meta: { title: 'News' }
      },
      {
         path: '/resources',
         component: Resources,
         meta: { title: 'Resources' }
      },
      {
         path: '/topnav',
         component: Topnav,
         meta: { title: 'Topnav' }
      },
      {
         path: '/tabsnav',
         component: Tabsnav,
         meta: { title: 'Tabsnav' }
      },
   ]
}