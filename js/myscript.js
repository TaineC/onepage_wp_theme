(function($){
    $(function(){

        $('.nav-link').on('click',function(e){

            //get current url without #
            var url = window.location.href
            var hashPos = url.search('#')
            if(hashPos != -1){
                url = url.substr(0,hashPos)
            }
            //get href and slug of the link you click on
            var href = $(this).attr('href')
            var hashPos = href.search('#')
            var slug = ''
            if(hashPos != -1){
                slug = href.substr(hashPos)
                href = href.substr(0,hashPos)
            }

            if(url == href && slug != ''){
                e.preventDefault()
                var offsetTop = $(slug).offset().top
                $('html,body').animate({scrollTop:offsetTop},1000)
            }
        })

    })
})(jQuery);