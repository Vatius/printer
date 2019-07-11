<template>
	<div class="modal-card" style="width: auto">
		<header class="modal-card-head">
			<p class="modal-card-title">Обновление информации</p>
		</header>
		<section class="modal-card-body">
			<b-field label="Имя">
				<b-input
					type="text"
					v-model="newName"
					placeholder="имя..."
					required>
				</b-input>
			</b-field>

			<b-field label="Телефон">
				<div class="field-body">
					<div class="field has-addons">
						<p class="control">
							<button class="button is-static">+</button>
						</p>
						<p class="control is-expanded">
							<b-input
								type="text"
								v-model="newTelephone"
								placeholder="79991112233"
								required>
							</b-input>
						</p>
					</div>
				</div>
			</b-field>

			<b-field
				label="Статус"
				type="is-info"
			>
				<b-select placeholder="Select a character" v-model="newStatus">
					<option value="1">новый</option>
					<option value="2">позвонил менеджер</option>
					<option value="3">на доставке</option>
					<option value="4">доставлен</option>
					<option value="5">клиент отказался</option>
				</b-select>
			</b-field>

		</section>
		<footer class="modal-card-foot">
			<button class="button" type="button" @click="$parent.close()">Закрыть</button>
			<button class="button is-primary" @click="save()">Сохранить</button>
		</footer>
	</div>
</template>

<script>
import { HTTP } from './../http-common.js'

export default {
	name: 'Update',
	props: ['id','fio','tel','status'],
	data () {
		return {
			newName: this.fio,
			newTelephone: this.tel,
			newStatus: this.status
		}
	},
	methods: {
		save () {
			if (!this.newName || !this.newTelephone) {
				return
			}
			HTTP.post('/update/'+this.id, {
				fio: this.newName,
				status: this.newStatus,
				tel: Number(this.newTelephone)
			}).then(res => {
				this.$emit('saved', res.data)
				this.$toast.open('Информация обновлена')
				this.$parent.close()
			})
		}
	}
}
</script>