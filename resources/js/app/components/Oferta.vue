<template>
 <div class="modal" :class="{active}">
	<div class="modal__wrapper">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-12 col-sm-10 offset-sm-1 col-md-10 offset-md-1 col-lg-8 offset-lg-2 offset-xl-1 col-xl-8 offset-xl-2">
					<div class="modal-body">
						<div class="modal__f-figure"></div>
						<div class="modal__s-figure"></div>
						<div class="modal-body__figure"></div>
						<div class="modal-body__cross" @click="active = false">
							<div class="times-svg"></div>
						</div>
						<!-- Oferta  -->
						<div class="modal__var">
							<div class="row">
								<div class="col-xl-6 offset-xl-3">
									<div class="modal__title">
										<span>Оферта</span>
									</div>
									<div class="modal__paragraph">
										<p>
											Event Outlet – информационный портал по поиску исполнителей на мероприятия.
											Обращаем ваше внимание на то, что данный портал, а также вся информация об услугах, товарах и ценах, предоставленная на нём, носит исключительно информационный характер и ни при каких условиях не является публичной офертой, определяемой положениями Статьи 437 Гражданского кодекса Российской Федерации. Для получения подробной информации о стоимости указанных товаров и (или) услуг, пожалуйста, обращайтесь к исполнителю напрямую по указанным контактным данным в его анкете.
										</p>
										<span>
											ГК РФ Статья 437. Приглашение делать оферты. Публичная оферта
										</span>
										<ol>
											<li>Реклама и иные предложения, адресованные неопределенному кругу лиц, рассматриваются как приглашение делать оферты, если иное прямо не указано в предложении.</li>
											<li>Содержащее все существенные условия договора предложение, из которого усматривается воля лица, делающего предложение, заключить договор на указанных в предложении условиях с любым, кто отзовется, признается офертой (публичная оферта).</li>
										</ol>
										<span>
											Рекомендации по безопасности
										</span>
										<p>
											Исполнители не являются сотрудниками Event Outlet и несут личную ответственность за качество предоставляемых услуг. При сотрудничестве с любым исполнителем мы рекомендуем всегда соблюдать базовые правила безопасности.
										</p>
										<ul>
											<li>Внимательно изучить и обсудить конкретные условия работы на вашем мероприятие.
                                                Прописать все условия и этапы сотрудничества в договоре или смете, составьте расписки о передаче денег или сохраняйте чеки.</li>
											<li>Прописывайте все условия и этапы сотрудничества в договоре или смете, составляйте расписки о передаче денег или сохраняйте чеки.</li>
										</ul>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</template>

<script>
export default {
    data() {
        return {
            active: false
        }
    },
    mounted() {
        document.querySelectorAll('.oferta-open-trigger').forEach(item => {
            item.addEventListener('click', e => {
                e.preventDefault();
                this.active = true;
            })
        });
    }
}
</script>
