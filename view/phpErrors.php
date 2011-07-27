<? if (count($__ERRORS)>0): ?>
	<ul class="php-errors">
		<?forEach($__ERRORS as $error):?>
			<li>
				<dl>
					<dt>Message</dt>
					<dd><?=$error->getMessage()?></dd>
					<dt>Error Code</dt>
					<dd><?=$error->getCode()?></dd>
					<?if ($tmp=$error->getFile()):?>
						<dt>File</dt>
						<dd><?=$tmp?></dd>
					<?endIf?>
					<?if ($tmp=$error->getTrace()):?>
						<dt style="display: none;">Trace</dt>
						<dd style="display: none;">
							<ul>
								<?forEach($tmp as $trace):?>
									<li>
										<dl>
											<dt>File</dt>
											<dd><?=$trace['file']?></dd>
											<dt>Line</dt>
											<dd><?=$trace['line']?></dd>
											<dt>Function</dt>
											<dd><?=$trace['function']?></dd>
											<dt>Args</dt>
											<dd>
												<ul>
													<?forEach($trace['args'] as $arg):?>
														<li><pre><?print_r($arg)?></pre></li>
													<?endForEach?>
												</ul>
											</dd>
										</dl>
									</li>
								<?endForEach?>
							</ul>
						</dd>
					<?endIf?>
					<dd><?=$error->getCode()?></dd>
					
				</dl>
			</li>
		<?endForEach?>
	</ul>
<? endIf ?>