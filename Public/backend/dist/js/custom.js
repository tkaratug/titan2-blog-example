// Reset Modal When Closed
$(".modal").on("hidden.bs.modal", function(){
    $(this).removeData();
});

$('body').on('hidden.bs.modal', '.modal', function () {
    $(this).removeData('bs.modal');
});

$('#remoteModal').on('hidden', function () {
    $(this).removeData('modal');
});
