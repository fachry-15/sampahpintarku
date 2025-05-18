<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class testingcontrollers extends Controller
{
    public function runPythonScript()
    {
        $process = new Process(['python', base_path('ann.py')]);
        $process->run();

        // Mengecek jika proses berjalan dengan sukses
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return response()->json([
            'output' => $process->getOutput()
        ]);
    }
}
