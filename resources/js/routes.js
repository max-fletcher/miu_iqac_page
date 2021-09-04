// Pages
import Home from "./pages/home"
import About from "./pages/about"
import Events from "./pages/events"
import SingleEvent from "./pages/single_event"
import News from "./pages/news"
import SingleNews from "./pages/single_news"
import Resources from "./pages/resources"
import People from "./pages/people"
import ContactUs from "./pages/contactus"
import NotFound from "./pages/notfound"
import ResourceNotFound from "./pages/resource_not_found"
import PhotoGallery from "./pages/photo_gallery"
import SinglePhotoGallery from "./pages/single_photo_gallery"
import Publications from "./pages/publications"
// Auth Pages
import Login from "./pages/auth/login"
import Register from "./pages/auth/register"
import PublicationsAuth from "./pages/auth/publications_auth"
// Admin Pages
import AdminPanel from "./pages/admin_pages/adminpanel"
// Carousel
import CarouselContent from "./pages/admin_pages/carousel_content"
import CarouselContentStore from "./pages/admin_pages/carousel_content_store"
import CarouselContentEdit from "./pages/admin_pages/carousel_content_edit"
// About
import AboutAdmin from "./pages/admin_pages/about_admin"
import AboutContentStore from "./pages/admin_pages/about_content_store"
import AboutContentEdit from "./pages/admin_pages/about_content_edit"
// People
import PeopleAdmin from "./pages/admin_pages/people_admin"
import PeopleStore from "./pages/admin_pages/people_section_store"
import PeopleEdit from "./pages/admin_pages/people_section_edit"
// Members
import MembersAdmin from "./pages/admin_pages/members_admin"
import MembersStore from "./pages/admin_pages/members_store"
import MembersEdit from "./pages/admin_pages/members_edit"

import EventsAdmin from "./pages/admin_pages/events_admin"
import NewsAdmin from "./pages/admin_pages/news_admin"
import ResourcesAdmin from "./pages/admin_pages/resources_admin"
import MainAdmin from "./pages/admin_pages/main_admin"
// scrapped components
import Topnav from "./pages/components/scrapped/topnav"
import Tabsnav from "./pages/components/scrapped/tabsnav"
import QuickLinksAccordion from "./pages/components/scrapped/quicklinksaccordion"
import CarouselText from "./pages/components/scrapped/carouseltext"
import OverlayCarousel from "./pages/components/scrapped/overlay_carousel"
import Bars from "./pages/components/scrapped/bars"
import Sandbox from "./pages/components/scrapped/sandbox"


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
         path: '/resource_not_found',
         component: ResourceNotFound,
         name: 'ResourceNotFound',
         meta: { title: '404 Resource Not Found' }
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
         path: '/events/:id',
         component: Events,
         name: 'Events',
         meta: { title: 'All Events' }
      },
      {
         path: '/events/single_event/:id',
         component: SingleEvent,
         name: 'SingleEvent',
         meta: { title: 'Single Event' }
      },
      {
         path: '/news',
         component: News,
         name: 'News',
         meta: { title: 'All News' }
      },
      {
         path: '/news/single_news/:id',
         component: SingleNews,
         name: 'SingleNews',
         meta: { title: 'Single News' }
      },
      {
         path: '/resources/:id',
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
         path: '/contact-us',
         component: ContactUs,
         name: 'ContactUs',
         meta: { title: 'Contact Us' }
      },
      {
         path: '/photo-gallery',
         component: PhotoGallery,
         name: 'PhotoGallery',
         meta: { title: 'All Photo Galleries' }
      },
      {
         path: '/single-gallery/:id',
         component: SinglePhotoGallery,
         name: 'SinglePhotoGallery',
         meta: { title: 'Gallery' }
      },
      {
         path: '/publications_auth/:id',
         component: PublicationsAuth,
         name: 'PublicationsAuth',
         meta: { title: 'Publications Password Page' },
      },
      {
         path: '/publications/:id',
         component: Publications,
         name: 'Publications',
         meta: { title: 'Publications Page' }
      },
      // Admin Pages
      {
         path: '/login/:message?',
         component: Login,
         name: 'Login',
         meta: { title: 'Login' },
         // beforeEnter: ( to, from, next) => {
         //    axios.get('/api/authenticated')
         //    .then(()=>{
         //       next({path: '/adminpanel/'})
         //    })
         // }
      },
      {
         path: '/register',
         component: Register,
         name: 'Register',
         meta: { title: 'Register' }
      },
      // Admin Panel
      {
         path: '/adminpanel',
         component: AdminPanel,
         name: 'AdminPanel',
         // meta: { title: 'Admin Panel' },
         children: [
            {
               path: 'main',
               component: MainAdmin,
               meta: { title: 'Admin Panel - Main Menu' },
            },
            {
               path: 'carousel_content',
               component: CarouselContent,
               meta: { title: 'Admin Panel - All Carousel Content' },
            },
            {
               path: 'carousel_content/store',
               component: CarouselContentStore,
               meta: { title: 'Admin Panel - Store Carousel Content' },
            },
            {
               path: 'carousel_content/edit/:id',
               component: CarouselContentEdit,
               meta: { title: 'Admin Panel - Edit Carousel Content' },
            },
            {
               path: 'about',
               component: AboutAdmin,
               meta: { title: 'Admin Panel - All About Content' },
            },
            {
               path: 'about_content/store',
               component: AboutContentStore,
               meta: { title: 'Admin Panel - Store About Content' },
            },
            {
               path: 'about_content/edit/:id',
               component: AboutContentEdit,
               meta: { title: 'Admin Panel - Edit About Content' },
            },
            {
               path: 'people',
               component: PeopleAdmin,
               meta: { title: 'Admin Panel - All People Content' },
            },
            {
               path: 'people/store',
               component: PeopleStore,
               meta: { title: 'Admin Panel - Store People Section' },
            },
            {
               path: 'people/edit/:id',
               component: PeopleEdit,
               meta: { title: 'Admin Panel - Edit People Section' },
            },
            {
               path: 'members/:people_id',
               component: MembersAdmin,
               meta: { title: 'Admin Panel - All Members' },
            },
            {
               path: 'members/:people_id/store',
               component: MembersStore,
               meta: { title: 'Admin Panel - Store Members Section' },
            },
            {
               path: 'members/:people_id/edit/:id',
               component: MembersEdit,
               meta: { title: 'Admin Panel - Edit Members Section' },
            },


            {
               path: 'events',
               component: EventsAdmin,
               meta: { title: 'Admin Panel - All Events Content' },
            },
            {
               path: 'news',
               component: NewsAdmin,
               meta: { title: 'Admin Panel - All News Content' },
            },
            {
               path: 'resources',
               component: ResourcesAdmin,
               meta: { title: 'Admin Panel - All Resources Content' },
            },
         ],
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
      {
         path: '/overlay-carousel/:id',
         component: OverlayCarousel,
         name: 'OverlayCarousel',
         meta: { title: 'Scrapped Overlay Carousel for Photo Gallery' }
      },
      {
         path: '/bars',
         component: Bars,
         name: 'Bars',
         meta: { title: 'Scrapped Bars' }
      },
      {
         path: '/sandbox',
         component: Sandbox,
         name: 'Sandbox',
         meta: { title: 'Scrapped Sandbox' }
      },
   ]
}