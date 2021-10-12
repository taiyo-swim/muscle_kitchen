 window.addEventListener('DOMContentLoaded',function () {
  'use strict';
  var prefix_order_list = 'how_to_cook_order_list_'; // 入力欄のname属性の接頭辞

  // "フォームの追加"ボタンを押した場合の処理
  $('#how_to_cook_btn_add').click(function () {
    var i, new_btn, len_list, new_list;

    // 入力欄を追加
    len_list = $('#how_to_cook_order_list > li').length;
    new_list = '<li><input id="how_to_cook" name="recipe_post[how_to_cook][]" placeholder="鶏むね肉を食べやすい大きさに切る。"></li>';
    $('#how_to_cook_order_list').append(new_list);

    // 削除ボタンの一旦全消去し、配置し直す
    $('#how_to_cook_order_list input[type="button"]').remove();
    len_list += 1;
    for (i = 0; i < len_list; i += 1) {
      new_btn = '<input type="button" value="-" style="margin-left: 10px; width: 30px; color: white; border:none; background-color: #384878;">';
      $('#how_to_cook_order_list > li').eq(i).append(new_btn);
    }
  });

  // 削除ボタンを押した場合の処理
  $(document).on('click', '#how_to_cook_order_list input[type="button"]', function (ev) {
    var i, idx, len_list;

    // 品目入力欄を削除
    idx = $(ev.target).parent().index();
    $('#how_to_cook_order_list > li').eq(idx).remove();

    len_list = $('#how_to_cook_order_list > li').length;

    // 入力欄がひとつになるなら、削除ボタンは不要なので消去
    if (len_list === 1) {
      $('#how_to_cook_order_list input[type="button"]').remove();
    }

    // 入力欄の番号を振り直す
    for (i = 0; i < len_list; i += 1) {
      $('#how_to_cook_order_list > li').eq(i).children('input[type="text"]').attr('name', prefix_order_list + i);
    }
  });
});



window.addEventListener('DOMContentLoaded',function () {
  'use strict';
  var prefix_order_list = 'ingredients_order_list_'; // 入力欄のname属性の接頭辞

  // "フォームの追加"ボタンを押した場合の処理
  $('#ingredients_btn_add').click(function () {
    var i, new_btn, len_list, new_list;

    // 入力欄を追加
    len_list = $('#ingredients_order_list > li').length;
    new_list = '<li><input id="ingredients" name="recipe_post[ingredients][]" placeholder="鶏むね肉"><input id="amount_of_ingredients" name="recipe_post[amount_of_ingredients][]" placeholder="200g"></li>';
    $('#ingredients_order_list').append(new_list);

    // 削除ボタンの一旦全消去し、配置し直す
    $('#ingredients_order_list input[type="button"]').remove();
    len_list += 1;
    for (i = 0; i < len_list; i += 1) {
      new_btn = '<input type="button" value="-" style="margin-left: 10px; width: 30px; color: white; border:none; background-color: #384878;">';
      $('#ingredients_order_list > li').eq(i).append(new_btn);
    }
  });

  // 削除ボタンを押した場合の処理
  $(document).on('click', '#ingredients_order_list input[type="button"]', function (ev) {
    var i, idx, len_list;

    // 入力欄を削除
    idx = $(ev.target).parent().index();
    $('#ingredients_order_list > li').eq(idx).remove();

    len_list = $('#ingredients_order_list > li').length;

    // 入力欄がひとつになるなら、削除ボタンは不要なので消去
    if (len_list === 1) {
      $('#ingredients_order_list input[type="button"]').remove();
    }

    // 入力欄の番号を振り直す
    for (i = 0; i < len_list; i += 1) {
      $('#ingredients_order_list > li').eq(i).children('input[type="text"]').attr('name', prefix_order_list + i);
    }
  });
});