<?php

use App\CalculateAmountFixed;
use App\LoadInputFile;
use App\Services\Bin\BinService;
use App\Services\Rate\RateService;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__, '.env');
$dotenv->safeLoad();

new App\App(
    new BinService(getenv('BINLIST')),
    new RateService(getenv('API_EXCHANGERATESAPI'), getenv('API_EXCHANGERATESAPI_TOKEN')),
    new CalculateAmountFixed(),
)(LoadInputFile::load($argv[1]));
