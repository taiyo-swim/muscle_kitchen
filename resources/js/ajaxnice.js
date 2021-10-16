$(function () {
var nice = $('.js-nice-toggle');
var niceRecipeId;

nice.on('click', function () {
    var $this = $(this);
    niceRecipeId = $this.data('recipeid');
    $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/recipes/' + niceRecipeId + '/nice',  //routeの記述
            type: 'POST', //受け取り方法の記述（GETもある）
            data: {
                'recipe_id': niceRecipeId //コントローラーに渡すパラメーター
            },
    })

        // Ajaxリクエストが成功した場合
        .done(function (data) {
            //lovedクラスを追加(いいねした時のいいねボタンの色の変更)
            $this.toggleClass('loved'); 
            
            //.nicesCountの次の要素のhtmlを「data.recipeNicesCount」の値に書き換える
            $this.next('.nicesCount').html(data.recipeNicesCount); 

        })
        // Ajaxリクエストが失敗した場合
        .fail(function (data, xhr, err) {
            //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
            console.log('エラー');
            console.log(err);
            console.log(xhr);
        });
    
    return false;
});
});