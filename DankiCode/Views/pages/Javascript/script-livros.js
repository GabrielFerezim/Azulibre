$(document).ready(function () {

    $('#abrirModal').click(function () {
        $("#PublicaçaoModal").show();
    });

    $('#FecharModalPubli').click(function () {
        $("#PublicaçaoModal").hide();
    });

    $('.AbrirInfoModal').click(function (e) {
        e.preventDefault();
        var infoModal = $("#infoModal");
        var titulo = $(this).data('titulo');
        var descricao = $(this).data('descricao');
        var genero = $(this).data('genero');
        var pdfPath = $(this).data('pdf');
        $('#info-titulo').text(titulo);
        $('#info-descricao').text(descricao);
        $('#info-genero').text("Gênero: " + genero);
        $('#AbrirPdf-Modal').data('pdf', pdfPath);
        infoModal.show();
    });

    $('#AbrirPdf-Modal').click(function (e) {
        e.preventDefault();
        var pdfPath = $(this).data('pdf');
        $('#pdfViewer').attr('src', pdfPath);
        $("#pdfModal").show();
        $("#infoModal").hide();
    });

    $('#FecharModalInfo').click(function () {
        $("#infoModal").hide();
    });

    $('#FecharModalPdf').click(function () {
        $("#pdfModal").hide();
    });

    $(window).click(function (event) {
        var PublicaçaoModal = $("#PublicaçaoModal");
        var infoModal = $("#infoModal");
        var pdfModal = $("#pdfModal");
        if (event.target == PublicaçaoModal[0]) {
            PublicaçaoModal.hide();
        }
        if (event.target == infoModal[0]) {
            infoModal.hide();
        }
        if (event.target == pdfModal[0]) {
            pdfModal.hide();
        }
    });
    console.log('O script externo está funcionando!');
});