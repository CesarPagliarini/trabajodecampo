
$.fn.datepicker.dates['es'] = {
    days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
    daysShort: ["Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab"],
    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octoubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    today: "Hoy",
    clear: "Borrar",
    format: "mm/dd/yyyy",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};
$(document).ready( () => {
    $("#dateClientBirth").datepicker({ language: 'es' });
});
