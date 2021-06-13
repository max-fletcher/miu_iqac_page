import Home from "./components/home";
import About from "./components/about";
import Members from "./components/members";
import Events from "./components/events";
import News from "./components/news";
import Resources from "./components/resources";
import NotFound from "./components/notfound";
import Topnav from "./components/topnav";

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
         meta: { title: 'sadaw' }
      },
   ]
}