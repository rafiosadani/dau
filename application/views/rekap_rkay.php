<!DOCTYPE html>
<html>

<head>
	<?php $this->load->view('partials/head') ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">


	<div class="box-body table-responsive">
		<table width="100%">
			<tr class="tableheader">
				<b>
					<td colspan="2" align="center">REKAP RKAY</td>
				</b>
			</tr>
		</table>
		<p>
			<p>
		<table width="100%" border="1">
            <!-- <thead> -->
                <tr>
                    <td rowspan="2" colspan="3" align="center">Nama Program</td>
                    <td colspan="5" align="center">Bulan Ini</td>
					<td colspan="5" align="center">Bulan Januari sd Bulan ini</td>
					<td colspan="5" align="center">Pencapaian Setahun</td>
                </tr>
				<tr>
                    <td>Perolehan 2019</td>
					<td>Perolehan 2018</td>
					<td>RKAY 2019</td>
					<td>rata2 1</td>
					<td>rata2 2</td>
					<td>Perolehan 2019</td>
					<td>Perolehan 2018</td>
					<td>RKAY 2019</td>
					<td>rata2 1</td>
					<td>rata2 2</td>
					<td>Perolehan 2019</td>
					<td>Perolehan 2018</td>
					<td>RKAY 2019</td>
					<td>rata2 1</td>
					<td>rata2 2</td>
                </tr>
				<?php
					$sum1 = $sum2 = $sum3 = $sum4 = $sum5 = $sum6 = $sum7 = $sum8 = $sum9 = 0; 
					foreach ($rkay as $value) {
						$sum1 += $value->per20191;
						$sum2 += $value->per20181;
						$sum3 += $value->rkay20191;
						$sum4 += $value->per20192;
						$sum5 += $value->per20182;
						$sum6 += $value->rkay20192;
						$sum7 += $value->per20193;
						$sum8 += $value->per20183;
						$sum9 += $value->rkay20193;
						?>
					<tr>
						<td><?php echo $value->rkay_2 ?></td>
						<td><?php echo $value->rkay_1 ?></td>
						<td><?php echo $value->nm_rkay ?></td>
						<td align="right"><?php echo number_format($value->per20191,0,'.',',') ?></td>
						<td align="right"><?php echo number_format($value->per20181,0,'.',',') ?></td>
						<td align="right"><?php echo number_format($value->rkay20191,0,'.',',') ?></td>
						<?php if ($value->per20181 == 0 || $value->per20191 == 0 ) : ?>
							<td align="right"><?php echo "0.00%" ?></td>
						<?php endif; ?><?php if ($value->per20181 != 0 && $value->per20191 != 0) : ?>
							<td align="right"><?php echo round(100*($value->per20181/$value->per20191),2)."%" ?></td>
						<?php endif; ?>
						<?php if ($value->per20181 == 0 || $value->rkay20191 == 0 ) : ?>
							<td align="right"><?php echo "0.00%" ?></td>
						<?php endif; ?><?php if ($value->per20181 != 0 && $value->rkay20191 != 0) : ?>
							<td align="right"><?php echo round(100*($value->per20181/$value->rkay20191),2)."%" ?></td>
						<?php endif; ?>
						<td align="right"><?php echo number_format($value->per20192,0,'.',',') ?></td>
						<td align="right"><?php echo number_format($value->per20182,0,'.',',') ?></td>
						<td align="right"><?php echo number_format($value->rkay20192,0,'.',',') ?></td>
						<?php if ($value->per20182 == 0 || $value->per20192 == 0 ) : ?>
							<td align="right"><?php echo "0.00%" ?></td>
						<?php endif; ?><?php if ($value->per20182 != 0 && $value->per20192 != 0) : ?>
							<td align="right"><?php echo round(100*($value->per20182/$value->per20192),2)."%" ?></td>
						<?php endif; ?>
						<?php if ($value->per20182 == 0 || $value->rkay20192 == 0 ) : ?>
							<td align="right"><?php echo "0.00%" ?></td>
						<?php endif; ?><?php if ($value->per20182 != 0 && $value->rkay20192 != 0) : ?>
							<td align="right"><?php echo round(100*($value->per20182/$value->rkay20192),2)."%" ?></td>
						<?php endif; ?>
						<td align="right"><?php echo number_format($value->per20193,0,'.',',') ?></td>
						<td align="right"><?php echo number_format($value->per20183,0,'.',',') ?></td>
						<td align="right"><?php echo number_format($value->rkay20193,0,'.',',') ?></td>
						<?php if ($value->per20183 == 0 || $value->per20193 == 0 ) : ?>
							<td align="right"><?php echo "0.00%" ?></td>
						<?php endif; ?><?php if ($value->per20183 != 0 && $value->per20193 != 0) : ?>
							<td align="right"><?php echo round(100*($value->per20183/$value->per20193),2)."%" ?></td>
						<?php endif; ?>
						<?php if ($value->per20183 == 0 || $value->rkay20193 == 0 ) : ?>
							<td align="right"><?php echo "0.00%" ?></td>
						<?php endif; ?><?php if ($value->per20183 != 0 && $value->rkay20193 != 0) : ?>
							<td align="right"><?php echo round(100*($value->per20183/$value->rkay20193),2)."%" ?></td>
						<?php endif; ?>
					</tr>
				<?php } ?>
				
				<tr>
					<th colspan="3">Total</th>
					<th style="text-align:right"><?php echo number_format($sum1,0,'.',',') ?></th>
					<th style="text-align:right"><?php echo number_format($sum2,0,'.',',') ?></th>
					<th style="text-align:right"><?php echo number_format($sum3,0,'.',',') ?></th>
					<?php if ($sum2 == 0 || $sum1 == 0 ) : ?>
						<th style="text-align:right"><?php echo "0.00%" ?></th>
					<?php endif; ?><?php if ($sum2 != 0 && $sum1 != 0) : ?>
						<th style="text-align:right"><?php echo round(100*($sum2/$sum1),2)."%" ?></th>
					<?php endif; ?>
					<?php if ($sum2 == 0 || $sum3 == 0 ) : ?>
						<th style="text-align:right"><?php echo "0.00%" ?></th>
					<?php endif; ?><?php if ($sum2 != 0 && $sum3 != 0) : ?>
						<th style="text-align:right"><?php echo round(100*($sum2/$sum3),2)."%" ?></th>
					<?php endif; ?>
					<th style="text-align:right"><?php echo number_format($sum4,0,'.',',') ?></th>
					<th style="text-align:right"><?php echo number_format($sum5,0,'.',',') ?></th>
					<th style="text-align:right"><?php echo number_format($sum6,0,'.',',') ?></th>
					<?php if ($sum5 == 0 || $sum4 == 0 ) : ?>
						<th style="text-align:right"><?php echo "0.00%" ?></th>
					<?php endif; ?><?php if ($sum5 != 0 && $sum4 != 0) : ?>
						<th style="text-align:right"><?php echo round(100*($sum5/$sum4),2)."%" ?></th>
					<?php endif; ?>
					<?php if ($sum5 == 0 || $sum6 == 0 ) : ?>
						<th style="text-align:right"><?php echo "0.00%" ?></th>
					<?php endif; ?><?php if ($sum5 != 0 && $sum6 != 0) : ?>
						<th style="text-align:right"><?php echo round(100*($sum5/$sum6),2)."%" ?></th>
					<?php endif; ?>
					<th style="text-align:right"><?php echo number_format($sum7,0,'.',',') ?></th>
					<th style="text-align:right"><?php echo number_format($sum8,0,'.',',') ?></th>
					<th style="text-align:right"><?php echo number_format($sum9,0,'.',',') ?></th>
					<?php if ($sum8 == 0 || $sum7 == 0 ) : ?>
						<th style="text-align:right"><?php echo "0.00%" ?></th>
					<?php endif; ?><?php if ($sum8 != 0 && $sum7 != 0) : ?>
						<th style="text-align:right"><?php echo round(100*($sum8/$sum7),2)."%" ?></th>
					<?php endif; ?>
					<?php if ($sum8 == 0 || $sum9 == 0 ) : ?>
						<th style="text-align:right"><?php echo "0.00%" ?></th>
					<?php endif; ?><?php if ($sum8 != 0 && $sum9 != 0) : ?>
						<th style="text-align:right"><?php echo round(100*($sum8/$sum9),2)."%" ?></th>
					<?php endif; ?>
				</tr>
				<!-- <tr>
					<td rowspan="2">Tidak Rutin</td>
                </tr>
				<tr>
					<td>a
					</td>
				<tr> -->
            <!-- </thead> -->
        </table>
	</div>



</body>
<?php $this->load->view('partials/js') ?>
<script>
//   $(function () {
//     $('#example1').DataTable()
//   })
</script>

</html>