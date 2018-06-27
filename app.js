$(document).ready(init);

function init() {
    //$('button').click(getData);
}

function getData() {
    var url = "https://api.appmonsta.com/v1/stores/itunes/reviews.json?language=EN" ;
  
    $.ajax({
        url: url,
        method: 'get',
        dataType: 'json',
        headers: {
            "authorization": "Basic YWU1NTliYzc5MWNhZTllNWZmYjFlNGEzMTA4MjI5YzRkZTU3NDRhMzoxMTEx"
        },
        success: function(response) {
            if(response.success) {
                console.log('response is ', response);
                //generateDOM(response.video);
        
            }else {
                console.log('wrong answer');
            }
        },
        error: function () {
            console.log('server not response');    
        }
    });
}

function generateDOM(videoList) {
    console.log('inside generateDom video ', videoList);
    //{title: "Cupcake Decorating Ideas | FUN and Easy Cupcake Recipes by So Yummy", 
    //    id: "YsxtAMlWfj8"}
    for(let i = 0; i< videoList.length; i++) {
        var videoID = videoList[i].id;
        console.log('video id ', videoID);
        var url = `https://www.youtube.com/watch?v=${videoID}`;
        console.log('url for each video ', url);



        var domURL = $('<div>', {
            class: 'url',
            text: url
        });

        // <iframe src="https://www.youtube.com/embed/YsxtAMlWfj8?rel=0" allowfullscreen>
        // </iframe>
        var iframe = $('<iframe>', {
            'src': `https://www.youtube.com/embed/${videoID}?rel=0`,
            'allowfullscreen': true
        }); 
        console.log('iframe to append ', iframe);
        $('.container').append(iframe);
    }
}