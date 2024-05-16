$(document).ready(function(){

    //HERO SLIDER
    $('#hero-slider').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        items: 1,
        smartSpeed: 1000,
        navText : ['PREV', 'NEXT'],
        responsive:{
            0:{
                nav:false,
            },
            768:{
                nav: true,
            },
        }
    })

    //COURTS SLIDER
    $('#courts-slider').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots:false,
        smartSpeed: 1000,
        margin: 24,
        navText:  ['NEXT', 'PREV'],
        responsive:{
            0:{
                item: 1,
                nav:false
            
            },
            767:{
               item: 2
            },
            1140:{
                items: 3,
                center:true,
                dots:true,
            }
        }
    })

    //COACHES SLIDER
    $('#coaches-slider').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots:false,
        smartSpeed: 1000,
        margin: 24,
        navText:  ['NEXT', 'PREV'],
        responsive:{
            0:{
                item: 1,
                nav:false
            
            },
            767:{
               item: 2
            },
            1140:{
                items: 3,
                center:true,
                dots:true,
            }
        }
    })
});

//SEARCH BAR
const toggleSearch = () => {
    const searchForm = document.querySelector('.search-form');
    const searchButton = document.querySelector('.search-button');
    const searchInput = document.querySelector('.search-input');
  
    searchButton.addEventListener('click', () => {
      searchForm.classList.toggle('active-search');
    });
  
    searchInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        e.preventDefault();
        searchInput.value = '';
        searchForm.classList.remove('active-search');
      }
    });
  };
  
  toggleSearch();