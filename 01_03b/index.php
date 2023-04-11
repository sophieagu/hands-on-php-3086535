<style>
	.coin {
		background: #999999;
		color: #333333;
		border-radius: 50%;
		padding: 50px;
		text-align: center;
		font-size: 2rem;
		font-weight: bold;
		width: 50px;
	}
</style>

<?php

function flip() {
	return ( 0 == rand(0,1) ) ? 'H' : 'T';
}

$H = 0;
$T = 0;

for( $i = 0; $i < 1000; $i++) {
	$flip = flip();
	${$flip}++;
}

echo '<p>Heads was flipped ' . $H/10 . '% of the time. Tails was flipped ' . $T/10 . '%.';

