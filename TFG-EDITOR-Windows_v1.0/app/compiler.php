<?php
$language = strtolower($_POST['language']);
$code = $_POST['code'];
$route = $_POST['route'];
$fileToExecute = $_POST['file_to_execute'];

$filePath = $route . "/" . $fileToExecute;
$programFile = fopen($filePath, "w");
fwrite($programFile, $code);
fclose($programFile);
$filePath = '"' . $route . "/" . $fileToExecute . '"';


if ($language == "python") {
    $output = shell_exec("py $filePath 2>&1");
    echo "<pre>";
    print_r($output);
    echo "</pre>";
} else if ($language == "cpp") {
    $dir = str_replace('\\', '/', realpath($route));
    $files = scandir($dir);
    $filePath = "";
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        } else {
            $path = $dir . '/' . $file;
            if (is_file($path) && isset(pathinfo($path)['extension'])) {
                $ext = pathinfo($path)['extension'];
                if ($ext === "cpp") {
                    $filePath = $filePath . ' "' . $path . '"';
                }
            }
        }
    }
    $random = substr(md5(mt_rand()), 0, 7);
    $outputExe = '"' . $dir . "/" . $random . ".exe" . '"';
    $errors = exec("g++  $filePath -O3 -Wall -o $outputExe 2>&1", $result);
    if (empty($result)) {
        $finalDir = $dir . "/";
        chdir($finalDir);

        $executable = $random . ".exe";
        $result = shell_exec("$executable");
        unlink($executable);
    }
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}