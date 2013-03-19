function editTimeline(pressButtonName) {
	if (pressButtonName == 'timeline_save') {
		nameValidation = new LiveValidation( "name", { validMessage: "Ok", wait: 100 });
		nameValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
		nameValidation.add( Validate.Length, { maximum: 255} );

		datetime_formatValidation = new LiveValidation( "datetime_format", { validMessage: "Ok", wait: 100 });
		datetime_formatValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
		datetime_formatValidation.add( Validate.Length, { maximum: 255} );
		
		interval_pixelValidation = new LiveValidation( "interval_pixel", { validMessage: "Ok", wait: 100 });
		interval_pixelValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
		interval_pixelValidation.add( Validate.Length, { maximum: 255} );
		
		widthValidation = new LiveValidation( "width", { validMessage: "Ok", wait: 100 });
		widthValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
			  
		bubble_widthValidation = new LiveValidation( "bubble_width", { validMessage: "Ok", wait: 100 });
		bubble_widthValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
		bubble_widthValidation.add( Validate.Numericality, 
			  { failureMessage: 'numberAlert' } );
			  
		bubble_heightValidation = new LiveValidation( "bubble_height", { validMessage: "Ok", wait: 100 });
		bubble_heightValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
		bubble_heightValidation.add( Validate.Numericality, 
			  { failureMessage: 'numberAlert' } );

		var automaticOnSubmit = document.adminForm.onsubmit;
		submitform = function(pressbutton) {
			document.adminForm.task.value = pressbutton;
			if (pressbutton == pressButtonName) {
				var valid = automaticOnSubmit();
				if (!valid) {
					return false;
				} else {
					document.adminForm.submit();
				}
			} else {
				document.adminForm.submit();
			}
		}
	}
	
	var tips = new Tips($$('.key'));
}

function editCategory(pressButtonName) {
	if (pressButtonName == 'category_save') {
		nameValidation = new LiveValidation( "name", { validMessage: "Ok", wait: 100 });
		nameValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
		nameValidation.add( Validate.Length, { maximum: 255} );

		var automaticOnSubmit = document.adminForm.onsubmit;
		submitform = function(pressbutton) {
			document.adminForm.task.value = pressbutton;
			if (pressbutton == pressButtonName) {
				var valid = automaticOnSubmit();
				if (!valid) {
					return false;
				} else {
					document.adminForm.submit();
				}
			} else {
				document.adminForm.submit();
			}
		}
	}
	
	var tips = new Tips($$('.key'));
}

function editYear(pressButtonName) {
	if (pressButtonName == 'year_save') {
		yearValidation = new LiveValidation( "year", { validMessage: "Ok", wait: 100 });
		yearValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
		yearValidation.add( Validate.Length, { maximum: 255} );
		yearValidation.add( Validate.Numericality, 
			  { failureMessage: 'numberAlert' } );

		var automaticOnSubmit = document.adminForm.onsubmit;
		submitform = function(pressbutton) {
			document.adminForm.task.value = pressbutton;
			if (pressbutton == pressButtonName) {
				var valid = automaticOnSubmit();
				if (!valid) {
					return false;
				} else {
					document.adminForm.submit();
				}
			} else {
				document.adminForm.submit();
			}
		}
	}
	
	var tips = new Tips($$('.key'));
}

function editEvent() {
	titleValidation = new LiveValidation( "title", { validMessage: "Ok", wait: 100 });
	titleValidation.add( Validate.Presence, 
		  { failureMessage: "Mandatory field" } );
	titleValidation.add( Validate.Length, { maximum: 255} );

	timelineIdValidation = new LiveValidation( "timeline_id", { validMessage: "Ok", wait: 100 });
	timelineIdValidation.add( Validate.Presence, 
		  { failureMessage: "Mandatory field" } );
	
	start_dateValidation = new LiveValidation( "start_date", { validMessage: "Ok", wait: 100 });
	start_dateValidation.add( Validate.Presence, 
		  { failureMessage: "Mandatory field" } );
	start_dateValidation.add( Validate.Length, { maximum: 255} );
	
	var automaticOnSubmit = document.adminForm.onsubmit;
	submitform = function(pressbutton) {
		document.adminForm.task.value = pressbutton;
		if (pressbutton == 'event_save') {
			var valid = automaticOnSubmit();
			if (document.getElementById('start_date') && document.getElementById('start_date').value && document.getElementById('start_date').value != '' && document.getElementById('end_date') && document.getElementById('end_date').value && document.getElementById('end_date') != '') {
				if (document.getElementById('start_date').value > document.getElementById('end_date').value && !((parseInt(document.getElementById('start_date').value) < 0) && parseInt(document.getElementById('start_date').value) < parseInt(document.getElementById('end_date').value))) {
					alert('Start date should be less than end date');
					valid = false;
				}
			}
			if (!valid) {
				return false;
			} else {
				document.adminForm.submit();
			}
		} else {
			document.adminForm.submit();
		}
	}
	
	var tips = new Tips($$('.key'));
}

function editBand() {
	titleValidation = new LiveValidation( "name", { validMessage: "Ok", wait: 100 });
	titleValidation.add( Validate.Presence, 
		  { failureMessage: "Mandatory field" } );
	titleValidation.add( Validate.Length, { maximum: 255} );

	timelineIdValidation = new LiveValidation( "timeline_id", { validMessage: "Ok", wait: 100 });
	timelineIdValidation.add( Validate.Presence, 
		  { failureMessage: "Mandatory field" } );
		
	var automaticOnSubmit = document.adminForm.onsubmit;
	submitform = function(pressbutton) {
		document.adminForm.task.value = pressbutton;
		if (pressbutton == 'band_save') {
			var valid = automaticOnSubmit();
			if (!valid) {
				return false;
			} else {
				document.adminForm.submit();
			}
		} else {
			document.adminForm.submit();
		}
	}
	
	var tips = new Tips($$('.key'));
}

function fromCSV(pressButtonName) {
	csvValidation = new LiveValidation( "csv", { validMessage: "Ok", wait: 100 });
	csvValidation.add( Validate.Presence, 
		  { failureMessage: "Mandatory field" } );
	
	if (!document.getElementById('timeline_id')) {
		nameValidation = new LiveValidation( "name", { validMessage: "Ok", wait: 100 });
		nameValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
	}
	
	var automaticOnSubmit = document.adminForm.onsubmit;
	submitform = function(pressbutton) {
		document.adminForm.task.value = pressbutton;
		if (pressbutton == pressButtonName) {
			var valid = automaticOnSubmit();
			if (!valid) {
				return false;
			} else {
				document.adminForm.submit();
			}
		} else {
			document.adminForm.submit();
		}
	}
	
	var tips = new Tips($$('.key'));
}

function fromK2(pressButtonName) {
	if (!document.getElementById('timeline_id')) {
		nameValidation = new LiveValidation( "name", { validMessage: "Ok", wait: 100 });
		nameValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
	}
	
	var automaticOnSubmit = document.adminForm.onsubmit;
	submitform = function(pressbutton) {
		document.adminForm.task.value = pressbutton;
		if (pressbutton == pressButtonName) {
			var valid = automaticOnSubmit();
			if (!valid) {
				return false;
			} else {
				document.adminForm.submit();
			}
		} else {
			document.adminForm.submit();
		}
	}
	
	var tips = new Tips($$('.key'));
}

function fromArticles(pressButtonName) {
	if (!document.getElementById('timeline_id')) {
		nameValidation = new LiveValidation( "name", { validMessage: "Ok", wait: 100 });
		nameValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
	
		var automaticOnSubmit = document.adminForm.onsubmit;
		submitform = function(pressbutton) {
			document.adminForm.task.value = pressbutton;
			if (pressbutton == pressButtonName) {
				var valid = automaticOnSubmit();
				if (!valid) {
					return false;
				} else {
					document.adminForm.submit();
				}
			} else {
				document.adminForm.submit();
			}
		}
	}
	
	var tips = new Tips($$('.key'));
}

function fromSQL(pressButtonName) {
	sqlValidation = new LiveValidation( "sql", { validMessage: "Ok", wait: 100 });
	sqlValidation.add( Validate.Presence, 
		  { failureMessage: "Mandatory field" } );
		  
	if (!document.getElementById('timeline_id')) {
		nameValidation = new LiveValidation( "name", { validMessage: "Ok", wait: 100 });
		nameValidation.add( Validate.Presence, 
			  { failureMessage: "Mandatory field" } );
	}
	
	var automaticOnSubmit = document.adminForm.onsubmit;
	submitform = function(pressbutton) {
		document.adminForm.task.value = pressbutton;
		if (pressbutton == pressButtonName) {
			var valid = automaticOnSubmit();
			if (!valid) {
				return false;
			} else {
				document.adminForm.submit();
			}
		} else {
			document.adminForm.submit();
		}
	}
	
	var tips = new Tips($$('.key'));
}