$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
}).resize();

$( document ).ready(function() {
    $('.toast').toast('show')

    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })
    // $('.list-group').remove();
    $('#searchbar').on('input',function(){
      console.log('recherche');
      $('.list-group').empty();
      $.ajax({
            url      : "../controleur/research.php",
            data     : {keywords: $('#searchbar').val()},
            cache    : false,
            dataType : "json",
            error    : function(request, error) {
                         alert("Erreur : responseText: "+request.responseText);
                       },
            success  : function(data) {

                         data.forEach(function(data){
                           console.log(data);
                           $("#list").append('<a href="../vue/edit_domain.php?domain='+data[0]+'" class="list-group-item list-group-item-action" style="border-radius : 0px">'+data[1]+'</a>');
                         })
                       }
       });
    });

    $('.list_group_item_action').on('click',function(){
      console.log('ok')
      console.log($(this).text());
    })

    console.log($('button').text());
});

// data-* attributes to scan when populating modal values
var ATTRIBUTES = ['myvalue','value-delete'];

$('[data-toggle="modal"]').on('click', function (e) {
  var $target = $(e.target);
  var modalSelector = $target.data('target');
  console.log('modal')
  ATTRIBUTES.forEach(function (attributeName) {
    console.log(attributeName)
    var $modalAttribute = $(modalSelector + ' #modal-' + attributeName);
    var dataValue = $target.data(attributeName);
    $modalAttribute.text(dataValue || '');
    console.log($modalAttribute);
    console.log(dataValue)
    $modalAttribute.val(dataValue);
  });
});


$(function () {
  $('table').
  on('click', 'th', function () {
    var index = $(this).index(),
    rows = [],
    cl = $(this).hasClass('asc') ? 'desc' : 'asc';
    $('#table th').removeClass('asc desc');
    $(this).addClass(cl);
    $('#table tbody tr').each(function (index, row) {
      rows.push($(row).detach());
    });
    rows.sort(function (a, b) {
      var aValue = $(a).find('td').eq(index).text(),
      bValue = $(b).find('td').eq(index).text();

      return aValue > bValue ?
      1 :
      aValue < bValue ?
      -1 :
      0;
    });

    $.each(rows, function (index, row) {
      $('#table tbody').append(row);
    });

    if ($(this).hasClass('desc')) {
      rows.reverse();
    }

  });
});
