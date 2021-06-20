import Home from "./pages/home";
import About from "./pages/about";
import Members from "./pages/members";
import Events from "./pages/events";
import News from "./pages/news";
import Resources from "./pages/resources";
import IQAC from "./pages/iqac";
import SAC from "./pages/sac";
import NotFound from "./pages/notfound";
import Topnav from "./pages/components/scrapped/topnav";
import Tabsnav from "./pages/components/scrapped/tabsnav";
import QuickLinksAccordion from "./pages/components/scrapped/quicklinksaccordion";

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
         path: '/people/iqac',
         component: IQAC,
         meta: { title: 'IQAC' }
      },
      {
         path: '/people/sac',
         component: SAC,
         meta: { title: 'SAC' }
      },
      {
         path: '/topnav',
         component: Topnav,
         meta: { title: 'Scrapped Topnav' }
      },
      {
         path: '/tabsnav',
         component: Tabsnav,
         meta: { title: 'Scrapped Tabsnav' }
      },
      {
         path: '/quicklinksaccordion',
         component: QuickLinksAccordion,
         meta: { title: 'Scrapped Quick Links Accordion' }
      },
   ]
}