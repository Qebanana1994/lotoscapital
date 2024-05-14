$(function(){

	calc();

	$('#plancalc').on('change', calc);
	$('#new_Sum, #inv_days, #compount_rate').bind('change keyup', calc).on('keypress');



});

function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

function calc() {

	var plan, amount, percent, days, total, p1, p2, p3, p4, p5, plantxt;

	plan = $('#plancalc').val();
	amount = $('#new_Sum').val();
	var comp_rate = $('#compount_rate');
	var comp_rate_val = $('#compount_rate').val();
	var comp_rate_val_def = 100;
	var days_count = 1;
	var final_profit = 0;
	var day_part = 0;


	switch (plan) {
					case '1':
			switch (true) {
				    case (amount<300):
					percent = 0;
					days = 0;
                    
		$('#total_profit').text('min 300 ₽');
		$('#total_percent').text('min 300 ₽');
		$('#total_return').text('min 300 ₽');
                    
					break;

				    case (amount<=4999):
					percent = 115;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text((sum1).toFixed(2)+'₽');
		$('#total_return').text((sum2).toFixed(2)+'₽');
		$('#total_percent').text((sum3).toFixed(1)+'%');
					break;


				    case (amount<=9999):
					percent = 130;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text((sum1).toFixed(2)+'₽');
		$('#total_return').text((sum2).toFixed(2)+'₽');
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;

                    

				    case (amount<=1000000):
					percent = 150;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text((sum1).toFixed(2)+'₽');
		$('#total_return').text((sum2).toFixed(2)+'₽');
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;
                    
                    
                    
                    
                    
                    
				    case (amount<=999999999999999):
					percent = 0;
					days = 0;


		$('#total_profit').text('max $10000000');
		$('#total_percent').text('max $10000000');
		$('#total_return').text('max $10000000');
                                      
                    

			};
    		$('#total_days').text('24 часа');

    
    }
    
    

    
    
    

	switch (plan) {
					case '2':
			switch (true) {
				    case (amount<30):
					percent = 0;
					days = 0;
                    
		$('#total_profit').text('min $30');
		$('#total_percent').text('min $30');
		$('#total_return').text('min $30');
                    
					break;

				    case (amount<=500):
					percent = 112;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;


				    case (amount<=1000):
					percent = 116;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;

                    

				    case (amount<=10000):
					percent = 121;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;
                    
                    
                    
                    
                    
                    
				    case (amount<=999999999999999):
					percent = 0;
					days = 0;


		$('#total_profit').text('max $10000000');
		$('#total_percent').text('max $10000000');
		$('#total_return').text('max $10000000');
                                      
                    

			};
      		$('#total_days').text('3 DAYS');

    
    }
    
    
    
    
    
    
    
    

	switch (plan) {
					case '3':
			switch (true) {
				    case (amount<30):
					percent = 0;
					days = 0;
                    
		$('#total_profit').text('min $30');
		$('#total_percent').text('min $30');
		$('#total_return').text('min $30');
                    
					break;

				    case (amount<=500):
					percent = 125;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;


				    case (amount<=1000):
					percent = 133;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;

                    

				    case (amount<=25000):
					percent = 143;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;
                    
                    
                    
                    
                    
                    
				    case (amount<=999999999999999):
					percent = 0;
					days = 0;


		$('#total_profit').text('max $10000000');
		$('#total_percent').text('max $10000000');
		$('#total_return').text('max $10000000');
                                      
                    

			};
    		$('#total_days').text('5 DAYS');

    
    }
    
    

	switch (plan) {
					case '4':
			switch (true) {
				    case (amount<30):
					percent = 0;
					days = 0;
                    
		$('#total_profit').text('min $30');
		$('#total_percent').text('min $30');
		$('#total_return').text('min $30');
                    
					break;

				    case (amount<=500):
					percent = 135;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;


				    case (amount<=1000):
					percent = 145;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;

                    

				    case (amount<=10000):
					percent = 156;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;
                    
                    
                    
                    
                    
                    
				    case (amount<=999999999999999):
					percent = 0;
					days = 0;


		$('#total_profit').text('max $10000000');
		$('#total_percent').text('max $10000000');
		$('#total_return').text('max $10000000');
                                      
                    

			};
  $('#total_days').text('7 DAYS');
    
    }
    
    
    
    

	switch (plan) {
					case '5':
			switch (true) {
				    case (amount<30):
					percent = 0;
					days = 0;
                    
		$('#total_profit').text('min $30');
		$('#total_percent').text('min $30');
		$('#total_return').text('min $30');
                    
					break;

				    case (amount<=500):
					percent = 160;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;


				    case (amount<=1000):
					percent = 180;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;

                    

				    case (amount<=10000):
					percent = 200;
					days = 1;
                    
		var totPerc = ((amount*percent/100)-amount).toFixed(2);
		var totRet = ((amount*percent/100)*days).toFixed(2);
                
		var sum1 = (eval (totPerc));
		var sum2 = (eval (totRet));

		var totPercc = ((days*percent)).toFixed(2);  
		var sum3 = (eval (totPercc));
                    
		$('#total_profit').text('$'+(sum1).toFixed(2));
		$('#total_return').text('$'+(sum2).toFixed(2));
		$('#total_percent').text((sum3).toFixed(1)+'%');

					break;
                    
                    
                    
                    
                    
                    
				    case (amount<=999999999999999):
					percent = 0;
					days = 0;


		$('#total_profit').text('max $10000000');
		$('#total_percent').text('max $10000000');
		$('#total_return').text('max $10000000');
                                      
                    

			};
  
    $('#total_days').text('10 DAYS');
    }
    
    

}