// Pages
import Home from "./pages/home";
import About from "./pages/about";
import Members from "./pages/members";
import Events from "./pages/events";
import News from "./pages/news";
import Resources from "./pages/resources";
import People from "./pages/people";
import SAC from "./pages/sac";
import ContactUs from "./pages/contactus";
import NotFound from "./pages/notfound";
//Auth Pages
import Login from "./pages/auth/login";
import Register from "./pages/auth/register";
import AdminPanel from "./pages/auth/adminpanel";
// scrapped components
import Topnav from "./pages/components/scrapped/topnav";
import Tabsnav from "./pages/components/scrapped/tabsnav";
import QuickLinksAccordion from "./pages/components/scrapped/quicklinksaccordion";
import CarouselText from "./pages/components/scrapped/carouseltext";

export default{
   mode: 'history',

   routes: [
      // Website Pages
      {
         path: '*',         
         component: NotFound,
         name: 'NotFound',
         meta: { title: '404 Not Found' }
      },
      {
         path: '/',
         component: Home,
         name: 'Home',
         meta: { title: 'Home' }
      },
      {
         path: '/about',         
         component: About,
         name: 'About',
         meta: { title: 'About Us' }
      },
      {
         path: '/members',         
         component: Members,
         name: 'Members',
         meta: { title: 'Members' }
      },
      {
         path: '/events',         
         component: Events,
         name: 'Events',
         meta: { title: 'Events' }
      },
      {
         path: '/news',         
         component: News,
         name: 'News',
         meta: { title: 'News' }
      },
      {
         path: '/resources',
         component: Resources,
         name: 'Resources',
         meta: { title: 'Resources' }
      },
      {
         path: '/people/:id',
         component: People,
         name: 'People',
         meta: { title: 'People' }
      },
      {
         path: '/people/sac',
         component: SAC,
         name: 'SAC',
         meta: { title: 'SAC' }
      },
      {
         path: '/contact-us',
         component: ContactUs,
         name: 'Contact Us',
         meta: { title: 'Contact Us' }
      },
      // Admin Pages
      {
         path: '/login/:message?',
         component: Login,
         name: 'Login',
         meta: { title: 'Login' }
      },
      {
         path: '/register',
         component: Register,
         name: 'Register',
         meta: { title: 'Register' }
      },
      {
         path: '/adminpanel',
         component: AdminPanel,
         name: 'AdminPanel',
         meta: { title: 'Admin Panel' },
         // To confirm if user is logged in or not
         beforeEnter: ( to, from, next) => {
            axios.get('/api/authenticated')
            .then(()=>{
               next()
            }).catch(()=>{
               return next({path: '/login',
               query: {
                  message: 'unauthenticated',
               }
            })
            })
         }
      },
      // Scrapped Components pages
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
      {
         path: '/carouseltext',
         component: CarouselText,
         meta: { title: 'Scrapped Carousel Text' }
      },
   ]
}