<!-- templates/reg-form.php -->
<?php $page['title'] = 'Anmeldeformular' ?>

<?php ob_start() ?>

<div class="row">
	<form method="post" action="index.php?action=show" class="col-sm-6 offset-sm-3 card card-body">
			<div class="row">
				<div class="col-sm-2">
					<label>Anrede</label>
					<input name="title" type="text" class="form-control" required focused>
				</div>
				<div class="col-sm-5">
					<label>Vorname</label>
					<input name="firstname" type="text" class="form-control" required>
				</div>
				<div class="col-sm-5">
					<label>Nachname</label>
					<input name="family" type="text" class="form-control" required>
				</div>

				<div class="col-sm-9">
					<label>Straße</label>
					<input name="street" type="text" class="form-control" required>
				</div>
				<div class="col-sm-3">
					<label>Hausnummer</label>
					<input name="number" type="text" class="form-control" required>
				</div>

				<div class="col-sm-4">
					<label>Postleitzahl</label>
					<input name="zip" type="text" class="form-control" required>
				</div>
				<div class="col-sm-8">
					<label>Stadt</label>
					<input name="city" type="text" class="form-control" required>
				</div>
				<div class="col-sm-12">
					<label>Mailadresse (Loginname)</label>
					<input name="email" type="email" class="form-control" required>
				</div>
				<div class="col-sm-12">
					<label>Promotion-Code</label>
					<input name="promocode" type="text" class="form-control" required>
					<small><i class="text-danger">
					<?php 
					$first=true; 
					foreach($promo->promocodes as $key => $value)
					{ 
						if ($first){ echo 'Beispiele: '; $first = false; }
						else { echo ', '; }
						echo $key; 
					} ?>
					</i></small>
				</div>
				<div class="col-sm-12">
					<label class="text-center">Geburtsdatum</label>
					<div class="container row">
						<select name="day" class="col-sm-3 form-control" required>
							<?php 
							for ($i = 1; $i < 32; $i++)
							{
								?>
								<option value="<?= $i ?>"><?= $i ?></option>
								<?php
							}
							?>
						</select>
						<select name="month" class="col-sm-3 form-control" required>
							<?php 
							for ($i = 1; $i < 13; $i++)
							{
								?>
								<option value="<?= $i ?>"><?= $i ?></option>
								<?php
							}
							?>
						</select>
						<select name="year" class="col-sm-6 form-control" required>
							<?php 
							$Y = date('Y');
							$fromY = (int)$Y - 100;
							for ($i = $Y-16; $i > $fromY; $i--)
							{
								?>
								<option value="<?= $i ?>"><?= $i ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<small><i>* Eine Registrierung soll erst ab 16 Jahre möglich sein.</i></small>
					<input name="lang" id="lang" type="hidden" value="">
					<script>
					var x = navigator.language; // Get browser language
					if (x == '') { x = navigator.browserLanguage; } // IE10 fix
					if (x == 'de') { document.getElementById("lang") = 'de'; }
					else { document.getElementById("lang") = 'en'; }
					</script>
				</div>
				<div class="col-sm-12 text-center">
					<br><button type="submit" class="btn btn-primary btn-lg text-uppercase">Registrieren</button>
				</div>
			</div>
	</form>
</div>
<?php $page['content'] = ob_get_clean() ?>

<?php include 'layout.php' ?>