$(function(){

// ---------------------- Функция ajax - запроса к серверу --------------------

    function func_query(parm, fun, callback) {
        
        let data_send = {
            action: 'ajax',
            func: fun,
            func_parm: parm
        };

        $.post("/", data_send, function(data_back) {

            if (data_back.status == "Succes") {                       
                callback(data_back.data);
            } else {
                console.log("ошибка запроса")
                 //Ajax запрос вернул ошибку...
            }
            
        }, 'json')

    } //end func_query

// ------------------Вывод групп в зависимости от выбора курса-----------------

	let $group = $("#group");
	let course = $('.course_select :selected').val();

    func_query(course, 'get_Groups', function(groups){
          
        for (let i=1; i < groups.length; i++){
            $new_item = $group.clone().appendTo(".group_select");
            $new_item.attr("value",groups[i].groups).addClass("new_item"); 
            $new_item.html(groups[i].groups);
        }

        $group.attr("value",groups[0].groups).attr("selected",true);
        $group.html(groups[0].groups);
        
    });//end func_query

    $('.course_select').on('change', function(){

		course = $('.course_select :selected').val();
		$(".new_item").remove();
		$group.attr("selected",false);

		func_query(course, 'get_Groups', function(groups){
                
	        for (let i=1; i < groups.length; i++){
	            $new_item = $group.clone().appendTo(".group_select");
	            $new_item.attr("value",groups[i].groups).addClass("new_item");; 
	            $new_item.html(groups[i].groups);
	        }

			$group.attr("value",groups[0].groups).attr("selected",true);
	        $group.html(groups[0].groups);
	        
	    });//end func_query

    });//end on

// ---------------------------Кнопка посмотреть--------------------------------

	let $div = $('.schedule');

    $('.look').on('click', function(){ 
    	
    	let arr = [];
    	arr[0] = $('.group_select :selected').val();
    	arr[1] = $('.day_select :selected').val() + $('.odd_select :selected').val();
    	$div.hide();

    	func_query(arr, 'get_Schedule', function(schedule){
    		
    		let str = "<table border='1'>";
      
	       	for (let i=1; i < (Object.keys(schedule[0]).length - 1); i++){
	       		str = str + "<tr><td style='width: 22px;'>" + i + ". </td>" + "<td style='width: 110px;'>" + schedule[0][i] + "</td><td>" + schedule[1][i] + "</td></tr>";
	       	}

            str = str + "</table>"

	       	$div.html(str).slideToggle(300);

	    });//end func_query

    });//end on

});//end ready