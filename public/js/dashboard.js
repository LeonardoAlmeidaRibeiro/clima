const qs = (selector) => document.querySelector(selector);
const qsa = (selector) => [...document.querySelectorAll(selector)];
const icon = (name, classes = '') => `<svg class="icon ${classes}" aria-hidden="true"><use href="#i-${name}"/></svg>`;
const escapeHtml = (value) => String(value).replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
const priorities = [
    {type:'rain', name:'Alagamento', count:156, severity:'Alta', badge:'badge-light-danger'},
    {type:'sun', name:'Calor excessivo', count:89, severity:'Alta', badge:'badge-light-danger'},
    {type:'drop', name:'Falta de água', count:64, severity:'Média', badge:'badge-light-warning'},
    {type:'fire', name:'Queimada', count:37, severity:'Média', badge:'badge-light-warning'},
    {type:'tree', name:'Queda de árvore', count:28, severity:'Baixa', badge:'badge-light-success'},
];
const points = [
    {x:20,y:15,count:1,type:'sun',region:'Asa Norte',period:'today'},
    {x:42,y:10,count:2,type:'drop',region:'Asa Norte',period:'today'},
    {x:63,y:18,count:1,type:'fire',region:'Plano Piloto',period:'week'},
    {x:35,y:30,count:12,type:'rain',region:'Ceilândia',period:'today'},
    {x:55,y:34,count:9,type:'rain',region:'Plano Piloto',period:'today'},
    {x:88,y:28,count:1,type:'tree',region:'Paranoá',period:'week'},
    {x:21,y:52,count:5,type:'rain',region:'Ceilândia',period:'week'},
    {x:7,y:56,count:1,type:'tree',region:'Ceilândia',period:'today'},
    {x:65,y:52,count:3,type:'drop',region:'Plano Piloto',period:'today'},
    {x:41,y:67,count:7,type:'sun',region:'Águas Claras',period:'today'},
    {x:89,y:62,count:1,type:'fire',region:'Paranoá',period:'week'},
    {x:62,y:76,count:3,type:'drop',region:'Águas Claras',period:'week'},
];
const actions = [
    {title:'Ampliação da rede de drenagem',type:'rain',region:'Asa Norte',status:'Em execução',progress:65,date:'30/11/2026'},
    {title:'Instalação de bebedouros públicos',type:'drop',region:'Ceilândia',status:'Em execução',progress:40,date:'15/12/2026'},
    {title:'Plano de arborização urbana',type:'tree',region:'Plano Piloto',status:'Planejada',progress:20,date:'20/12/2026'},
    {title:'Manutenção de galerias pluviais',type:'rain',region:'Águas Claras',status:'Em execução',progress:80,date:'25/11/2026'},
    {title:'Recuperação de áreas verdes',type:'tree',region:'Paranoá',status:'Planejada',progress:15,date:'15/01/2027'},
];
let allActions = false;
let zoom = 1;
let city = 'brasilia';
const cities = {
    brasilia: {name:'Brasília, DF',territory:'Distrito Federal',reports:'128',critical:'7',actions:'23',positive:'78<small>%</small>',population:'356 <small>mil</small>'},
    goiania: {name:'Goiânia, GO',territory:'Goiânia',reports:'86',critical:'4',actions:'16',positive:'82<small>%</small>',population:'214 <small>mil</small>'},
    saopaulo: {name:'São Paulo, SP',territory:'São Paulo',reports:'342',critical:'19',actions:'58',positive:'74<small>%</small>',population:'892 <small>mil</small>'},
};
const dialog = bootstrap.Modal.getOrCreateInstance(qs('#detail-dialog'));
const notificationDropdown = bootstrap.Dropdown.getOrCreateInstance(qs('#notification-toggle'));
const notificationToast = bootstrap.Toast.getOrCreateInstance(qs('#toast'), {delay: 4000});
KTDrawer.createInstances();
const sidebarDrawer = KTDrawer.getInstance(qs('#sidebar'));
function showDialog(title, body) {
    qs('#dialog-content').innerHTML = `<h2 id="detail-title">${escapeHtml(title)}</h2>${body}`;
    dialog.show();
}
function toast(message) {
    qs('#toast .toast-body').textContent = message;
    notificationToast.show();
}
function detailGrid(items) {
    return `<div class="detail-grid">${items.map(([label,value])=>`<div><small>${escapeHtml(label)}</small><strong>${escapeHtml(value)}</strong></div>`).join('')}</div>`;
}
function renderMap() {
    const category = qs('#category-filter').value;
    const period = qs('#period-filter').value;
    const region = qs('#region-filter').value;
    const filtered = points.filter(point => (category === 'all' || point.type === category) && (period === 'all' || period === 'week' || point.period === 'today') && (region === 'all' || point.region === region));
    qs('#map-markers').innerHTML = filtered.map(point => {
        const index = points.indexOf(point);
        const style = point.count >= 10 ? 'red' : point.count >= 4 ? 'orange' : point.count === 1 ? (point.type === 'tree' ? 'green' : 'orange pin-marker') : 'blue';
        const categoryName = priorities.find(p=>p.type === point.type).name;
        return `<button class="map-marker ${style}" style="left:${point.x}%;top:${point.y}%" data-point="${index}" aria-label="${point.count} ocorrência(s) de ${categoryName} em ${point.region}">${point.count === 1 ? icon(point.type) : point.count}</button>`;
    }).join('');
    qs('#map-result-count').textContent = `${filtered.length} ${filtered.length === 1 ? 'ponto' : 'pontos'} no mapa`;
    qs('#map-empty').hidden = filtered.length > 0;
    qsa('[data-point]').forEach(button => button.addEventListener('click', () => {
        const point = points[Number(button.dataset.point)];
        const priority = priorities.find(p=>p.type === point.type);
        showDialog(priority.name, `<p>Resumo dos relatos agrupados neste ponto do mapa ilustrativo de Brasília.</p>${detailGrid([['Região',point.region],['Relatos',point.count],['Prioridade',priority.severity],['Período',point.period === 'today' ? 'Hoje' : 'Esta semana']])}<p>Os dados deste ambiente são fictícios e servem para apresentar a experiência do painel.</p>`);
    }));
}
function renderPriorities() {
    qs('#priority-list').innerHTML = priorities.map((p,index)=>`<button class="priority-row" data-priority="${index}" aria-label="Filtrar ${p.name}: ${p.count} ocorrências, prioridade ${p.severity}"><span class="priority-rank">${index+1}</span>${icon(p.type,`priority-icon ${p.type}`)}<span class="priority-copy"><strong>${p.name}</strong><small>${p.count} ocorrências</small></span><span class="badge ${p.badge}">${p.severity}</span></button>`).join('');
    qsa('[data-priority]').forEach(button=>button.addEventListener('click',()=>{
        qs('#category-filter').value = priorities[Number(button.dataset.priority)].type;
        qs('#period-filter').value = 'all';
        qs('#region-filter').value = 'all';
        renderMap();
        qs('#mapa').scrollIntoView({behavior:'smooth',block:'start'});
        toast(`Mapa filtrado: ${priorities[Number(button.dataset.priority)].name}`);
    }));
}
function showAction(index) {
    const action = actions[index];
    showDialog(action.title, `${detailGrid([['Região',action.region],['Status',action.status],['Progresso',`${action.progress}%`],['Previsão',action.date]])}<p>Ação demonstrativa coordenada pela equipe municipal. O acompanhamento reúne etapas de planejamento, mobilização e execução.</p><div class="progress-row"><span class="progress-track" style="width:100%;height:9px"><i style="width:${action.progress}%"></i></span></div>`);
}
function renderActions() {
    const list = allActions ? actions : actions.slice(0,3);
    qs('#actions-body').innerHTML = list.map((action,index)=>`<tr tabindex="0" role="button" data-action="${index}" aria-label="Detalhes: ${action.title}"><td>${escapeHtml(action.title)}</td><td class="type-cell ${action.type}">${icon(action.type)}${priorities.find(p=>p.type===action.type).name}</td><td>${escapeHtml(action.region)}</td><td><span class="badge ${action.status === 'Planejada' ? 'badge-light-warning' : 'badge-light-primary'}">${action.status}</span></td><td class="progress-cell"><div class="progress-row"><span class="progress-track" role="progressbar" aria-label="Progresso de ${escapeHtml(action.title)}" aria-valuenow="${action.progress}" aria-valuemin="0" aria-valuemax="100"><i style="width:${action.progress}%"></i></span><span>${action.progress}%</span></div></td><td>${action.date}</td></tr>`).join('');
    qs('#action-count').textContent = `${list.length} de ${actions.length} ações`;
    qs('#all-actions').innerHTML = allActions ? 'Mostrar menos' : `Ver todas ${icon('arrow','small')}`;
    qsa('[data-action]').forEach(row=>{
        row.addEventListener('click',()=>showAction(Number(row.dataset.action)));
        row.addEventListener('keydown',event=>{if(event.key === 'Enter' || event.key === ' ') {event.preventDefault();showAction(Number(row.dataset.action));}});
    });
}
function exportReport() {
    const rows = [['Ambiente demonstrativo — ações fictícias de Brasília'],['Ação','Tipo','Região','Status','Progresso (%)','Previsão'],...actions.map(action=>[action.title,priorities.find(p=>p.type===action.type).name,action.region,action.status,action.progress,action.date])];
    const csv = '\uFEFF' + rows.map(row=>row.map(value=>`"${String(value).replaceAll('"','""')}"`).join(';')).join('\r\n');
    const url = URL.createObjectURL(new Blob([csv],{type:'text/csv;charset=utf-8;'}));
    const link = document.createElement('a');link.href=url;link.download='clima-na-pele-acoes-demonstrativas.csv';link.click();setTimeout(()=>URL.revokeObjectURL(url),1000);
    toast('Relatório demonstrativo exportado.');
}
function setZoom(value) {
    zoom = Math.max(1,Math.min(1.8,value));
    qs('#map-scene').style.transform = `scale(${zoom})`;
    qs('#zoom-in').disabled = zoom >= 1.8;
    qs('#zoom-out').disabled = zoom <= 1;
}
qs('#zoom-in').addEventListener('click',()=>setZoom(zoom+.2));
qs('#zoom-out').addEventListener('click',()=>setZoom(zoom-.2));
qs('#map-reset').addEventListener('click',()=>{setZoom(1);toast('Mapa centralizado.');});
['#category-filter','#period-filter','#region-filter'].forEach(selector=>qs(selector).addEventListener('change',renderMap));
qs('#clear-filters').addEventListener('click',()=>{['#category-filter','#period-filter','#region-filter'].forEach(selector=>qs(selector).value='all');renderMap();});
qs('#legend-toggle').addEventListener('click',()=>{
    const hidden = !qs('#map-legend').hidden;
    qs('#map-legend').hidden = hidden;qs('#legend-toggle').setAttribute('aria-expanded',String(!hidden));
});
qs('#all-actions').addEventListener('click',()=>{allActions=!allActions;renderActions();});
qs('#download-report').addEventListener('click',exportReport);
qs('#all-priorities').addEventListener('click',()=>showDialog('Prioridades da semana', `<p>Distribuição demonstrativa dos relatos por categoria em Brasília.</p><div class="dialog-list">${priorities.map(p=>`<div>${icon(p.type)}<span><strong>${p.name}</strong> · ${p.count} ocorrências · ${p.severity}</span></div>`).join('')}</div>`));
qs('#all-updates').addEventListener('click',()=>showDialog('Atualizações recentes',`<p>Acompanhe as últimas movimentações do território.</p><div class="dialog-list"><div>${icon('check')} Limpeza de drenagem em andamento · há 25 min</div><div>${icon('pin')} 12 novos relatos recebidos · há 48 min</div><div>${icon('sun')} Alerta de calor excessivo · há 1 h</div><div>${icon('tree')} Nova missão de arborização · há 2 h</div><div>${icon('file')} Relatório semanal disponível · há 3 h</div></div>`));
const dialogContents = {
    participacao:['Participação que transforma','<p>Uma cidade mais resiliente começa com a experiência de quem vive nela. O Clima na Pele aproxima cidadãos e gestores para transformar relatos ambientais em ações acompanhadas pela população.</p><div class="dialog-list"><div>'+icon('pin')+' Identifique ocorrências no território</div><div>'+icon('rain')+' Organize prioridades e acompanhe ações</div><div>'+icon('users')+' Escute a população e avalie os resultados</div></div>'],
    ajuda:['Como usar o painel','<p>Selecione um território no topo para explorar os indicadores de demonstração. Clique nos pontos do mapa para consultar os relatos, use os filtros para refinar a visualização e selecione uma ação para ver seu andamento.</p><p>O relatório das ações pode ser baixado em CSV. As seções do menu lateral levam diretamente às informações na página.</p>'],
    perfil:['Gestor Municipal','<p>Perfil ilustrativo da equipe de administração municipal.</p>'+detailGrid([['Papel','Gestor municipal'],['Território','Brasília, DF'],['Área','Administração'],['Ambiente','Demonstração']])+'<p>O painel apresenta a interface de gestão. A autenticação e as permissões reais serão conectadas ao fluxo de acesso do projeto.</p>'],
    indicadores:['Sobre os indicadores','<p>O gráfico ilustra a comparação entre fragilidade climática e percepção negativa da população, em escala de 0 a 100. Clique nas legendas para mostrar ou ocultar cada série.</p><p>Os valores são demonstrativos e não foram obtidos de uma fonte oficial. A interpretação considera contexto e período; a comparação não estabelece uma relação de causa e efeito.</p>'],
    missao:['Missão: um bairro mais verde','<p>Objetivo: reunir 100 contribuições de moradores para identificar áreas que precisam de arborização, manutenção ou recuperação ambiental.</p>'+detailGrid([['Participações','68 de 100'],['Território','Plano Piloto'],['Status','Em andamento'],['Meta','100 contribuições']])+'<p>Esta missão é uma prévia demonstrativa do engajamento cidadão.</p>'],
};
qsa('[data-dialog]').forEach(button=>button.addEventListener('click',()=>showDialog(...dialogContents[button.dataset.dialog])));
qs('#mark-read').addEventListener('click',()=>{
    qs('.notification-count').hidden=true;qs('.nav-count').hidden=true;
    qs('#notification-toggle').setAttribute('aria-label','Notificações: nenhuma não lida');
    notificationDropdown.hide();toast('Todas as notificações foram marcadas como lidas nesta sessão.');
});
qsa('[data-alert]').forEach(button=>button.addEventListener('click',()=>{
    notificationDropdown.hide();
    showDialog(button.dataset.alert,'<p>Alerta de demonstração para acompanhamento da equipe municipal. Consulte os relatos e as prioridades do território para organizar as próximas providências.</p>');
}));
function closeMenu() { if (sidebarDrawer) sidebarDrawer.hide(); }
if (sidebarDrawer) {
    sidebarDrawer.on('kt.drawer.shown', () => qs('#menu-toggle').setAttribute('aria-expanded','true'));
    sidebarDrawer.on('kt.drawer.hidden', () => qs('#menu-toggle').setAttribute('aria-expanded','false'));
}
qsa('[data-nav]').forEach(link=>link.addEventListener('click',event=>{
    qsa('[data-nav]').forEach(item=>{item.classList.remove('active');item.removeAttribute('aria-current');});
    link.classList.add('active');link.setAttribute('aria-current','page');closeMenu();
    if(link.dataset.nav === 'relatorios'){event.preventDefault();showDialog('Relatórios do território','<p>Exporte a relação completa de ações de demonstração em formato CSV. O arquivo inclui categoria, região, status, progresso e previsão de entrega.</p><button class="btn btn-sm btn-outline btn-outline-success button button-outline" id="modal-export">Baixar relatório de ações</button>');qs('#modal-export').addEventListener('click',exportReport);}
}));
document.addEventListener('keydown',event=>{if(event.key==='Escape'){closeMenu();notificationDropdown.hide();qs('#map-legend').hidden=true;qs('#legend-toggle').setAttribute('aria-expanded','false');}});
qs('#city').addEventListener('change',event=>{
    city=event.target.value;const data=cities[city];
    qs('#territory-label').textContent=data.name;
    qsa('[data-stat]').forEach(element=>element.innerHTML=data[element.dataset.stat]);
    toast(city==='brasilia'?'Visão de Brasília selecionada.':'Indicadores de exemplo atualizados. O mapa e as ações permanecem na demonstração de Brasília.');
});
const climateChart = new ApexCharts(qs('#climate-chart'), {
    chart: {type:'line', height:190, fontFamily:'inherit', toolbar:{show:false}, zoom:{enabled:false}, animations:{enabled:!window.matchMedia('(prefers-reduced-motion: reduce)').matches}},
    series: [
        {name:'Fragilidade climática', data:[62,66,58,68,51,61,79]},
        {name:'Percepção negativa', data:[32,27,28,39,29,24,49]},
    ],
    colors:['#098951','#0b8cfa'],
    stroke:{width:2.5, curve:'straight', dashArray:[0,5]},
    markers:{size:3, strokeWidth:1, hover:{size:5}},
    xaxis:{categories:['Dez','Jan','Fev','Mar','Abr','Mai','Jun'], axisBorder:{show:false}, axisTicks:{show:false}, labels:{style:{colors:'#788ba0',fontSize:'11px'}}},
    yaxis:{min:0,max:100,tickAmount:2, labels:{style:{colors:'#788ba0',fontSize:'11px'}}},
    grid:{borderColor:'#eef2f3',padding:{left:0,right:12,top:-15,bottom:-8}},
    legend:{show:false}, dataLabels:{enabled:false},
    tooltip:{theme:'light',y:{formatter:value => `${value} de 100`}},
});
climateChart.render();
qsa('.chart-toggle').forEach(button=>button.addEventListener('click',()=>{
    const active=button.classList.toggle('active');
    button.setAttribute('aria-pressed',String(active));
    climateChart.toggleSeries(button.dataset.series==='fragility' ? 'Fragilidade climática' : 'Percepção negativa');
}));
renderMap();renderPriorities();renderActions();setZoom(1);
