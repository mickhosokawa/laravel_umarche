// import Swiper JS
//import Swiper from 'swiper';

import 'swiper/swiper-bundle.css';

// core version + navigation, pagination modules:
import Swiper, { Navigation, Pagination } from 'swiper';


  // configure Swiper to use modules
  SwiperCore.use([Navigation, Pagination]);

  const swiper = new Swiper('.swiper', {
    // Optional parameters
    // direction: 'vertical',
    loop: true,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  
    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });

