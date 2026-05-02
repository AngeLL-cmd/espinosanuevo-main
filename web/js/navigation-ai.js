/**
 * Modal de búsqueda asistida (embeddings Hugging Face + catálogo local).
 */
(function () {
    'use strict';

    function getMeta(name) {
        var el = document.querySelector('meta[name="' + name + '"]');
        return el ? el.getAttribute('content') : '';
    }

    function getEndpointUrl() {
        var holder = document.getElementById('ene-ai-endpoint');
        if (holder && holder.dataset && holder.dataset.url) {
            return holder.dataset.url;
        }
        return '';
    }

    function setVisible(el, visible) {
        if (!el) return;
        el.classList.toggle('d-none', !visible);
    }

    function resetUi(alertBox, resultBox, resultsList, warnBox, submitBtn) {
        setVisible(alertBox, false);
        setVisible(resultBox, false);
        setVisible(warnBox, false);
        setVisible(resultsList, false);
        if (resultsList) {
            resultsList.innerHTML = '';
        }
        if (warnBox) {
            warnBox.textContent = '';
        }
        if (submitBtn) submitBtn.disabled = false;
    }

    document.addEventListener('DOMContentLoaded', function () {
        var modalEl = document.getElementById('eneAiNavModal');
        if (!modalEl) return;

        var form = document.getElementById('eneAiNavForm');
        var input = document.getElementById('eneAiNavInput');
        var submitBtn = document.getElementById('eneAiNavSubmit');
        var alertBox = document.getElementById('eneAiNavAlert');
        var resultBox = document.getElementById('eneAiNavResult');
        var messageEl = document.getElementById('eneAiNavMessage');
        var resultsList = document.getElementById('eneAiNavResultsList');
        var warnBox = document.getElementById('eneAiNavWarning');

        modalEl.addEventListener('hidden.bs.modal', function () {
            resetUi(alertBox, resultBox, resultsList, warnBox, submitBtn);
            if (input) input.value = '';
        });

        if (!form || !input) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var url = getEndpointUrl();
            if (!url) {
                setVisible(alertBox, true);
                alertBox.className = 'alert alert-danger';
                alertBox.textContent = 'No se encontró la URL del servicio.';
                return;
            }

            var q = (input.value || '').trim();
            if (!q) {
                setVisible(alertBox, true);
                alertBox.className = 'alert alert-warning';
                alertBox.textContent = 'Escribe qué buscas.';
                return;
            }

            var csrfParam = getMeta('csrf-param');
            var csrfToken = getMeta('csrf-token');
            var body = new URLSearchParams();
            body.set('q', q);
            if (csrfParam && csrfToken) {
                body.set(csrfParam, csrfToken);
            }

            resetUi(alertBox, resultBox, resultsList, warnBox, submitBtn);
            submitBtn.disabled = true;
            submitBtn.textContent = 'Buscando…';

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: body.toString(),
                credentials: 'same-origin'
            })
                .then(function (res) {
                    return res.json().then(function (data) {
                        return { ok: res.ok, data: data };
                    });
                })
                .then(function (pack) {
                    var data = pack.data || {};
                    if (!pack.ok || !data.ok) {
                        setVisible(alertBox, true);
                        alertBox.className = 'alert alert-warning';
                        alertBox.textContent = data.message || 'No se pudo completar la búsqueda.';
                        return;
                    }

                    setVisible(resultBox, true);
                    if (messageEl) {
                        messageEl.textContent = data.message || '';
                    }

                    var hasList = resultsList && Array.isArray(data.results) && data.results.length > 0;
                    if (!hasList && !data.url) {
                        setVisible(alertBox, true);
                        alertBox.className = 'alert alert-warning';
                        alertBox.textContent = 'No se recibieron sugerencias. Inténtalo de nuevo.';
                        setVisible(resultBox, false);
                        return;
                    }

                    if (resultsList && Array.isArray(data.results) && data.results.length > 0) {
                        resultsList.innerHTML = '';
                        data.results.forEach(function (item) {
                            if (!item || !item.url) return;
                            var a = document.createElement('a');
                            a.href = item.url;
                            a.className = 'list-group-item list-group-item-action ene-ai-nav-hit py-3';
                            a.setAttribute('role', 'listitem');

                            var title = document.createElement('div');
                            title.className = 'ene-ai-nav-hit-title fw-semibold';
                            title.textContent = item.title || item.url;

                            a.appendChild(title);
                            resultsList.appendChild(a);
                        });
                        setVisible(resultsList, resultsList.childElementCount > 0);
                    } else if (data.url && resultsList) {
                        var fallback = document.createElement('a');
                        fallback.href = data.url;
                        fallback.className = 'list-group-item list-group-item-action ene-ai-nav-hit py-3';
                        var t = document.createElement('div');
                        t.className = 'ene-ai-nav-hit-title fw-semibold';
                        t.textContent = data.title || data.url;
                        fallback.appendChild(t);
                        resultsList.innerHTML = '';
                        resultsList.appendChild(fallback);
                        setVisible(resultsList, true);
                    }

                    if (data.apiWarning && warnBox) {
                        warnBox.textContent = data.apiWarning;
                        setVisible(warnBox, true);
                    }
                })
                .catch(function () {
                    setVisible(alertBox, true);
                    alertBox.className = 'alert alert-danger';
                    alertBox.textContent = 'Error de red. Inténtalo de nuevo.';
                })
                .finally(function () {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Buscar';
                });
        });
    });
})();
