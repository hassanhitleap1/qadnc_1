let SITE_URL = getSiteUrl() ;

function openMobileMenu() {
    document.getElementById("header").classList.toggle("offcanvas-menu")
}

function closeMobileMenu() {
    document.getElementById("header").classList.remove("offcanvas-menu")
}

$(document).ready(function () {
    $('.center').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        rtl: true,
        autoplaySpeed: 2000,
        centerPadding: '60px',
        responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
                centerMode: true,
                slidesToShow: 1
              }
            }
          ]
      });
});

function register_coure(event,course_id, is_logddin,registed){
    // check is_logddin
   
    event.preventDefault(); 
    if(is_logddin){
        const Http = new XMLHttpRequest();
        if(registed){
            const url=`/student-courses/unregister?id=${course_id}`;
            Http.open("GET", url);
            Http.send();
            Http.onreadystatechange = (e) => {
                
                document.getElementById(`st_${course_id}`).textContent='تسجيل في الدورة';
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'تم الغاء تسجيلك بنجاح',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  setTimeout(function(){
                    location.reload();
                  },1000);
                
            }
        }else{
            const url=`/student-courses/register?course_id=${course_id}`;
            Http.open("GET", url);
            Http.send();
            Http.onreadystatechange = (e) => {
              
                document.getElementById(`st_${course_id}`).textContent='ألغاء التسجيل';
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'تم تسجيلك بنجاح',
                    showConfirmButton: false,
                    timer: 1500
                  });
                 
                  setTimeout(function(){
                    location.reload();
                  },1000);
            }
        }
       
    
    }else{
        alert('قم بتسجيل')
        window.location.href = `/site/login`;

    }

}


function getSiteUrl() {
    let site_url=window.location.host;
    if (site_url=='localhost:8080'){
        return '';
    }
    return site_url+'/web';
}

$('.scroll').click(function(e) {
    e.preventDefault();
    $('html, body').animate({
        scrollTop: $('#' + $(this).attr('target')).offset().top - 100
    }, 1000);
});
