/**
 * Description of main.js
 *
 * @author Franz Orbezo
 */

function btnModal(url) {
    $('#contenido-modal').load(url);
    $('#modal').modal({
        keyboard: false,
        backdrop: 'static',
        show: true
    });
}