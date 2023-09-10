<?php

namespace App\Models;

class AlgoritmaGenetika
{
  public function start_algorithm($pc, $pm, $total_gen, $total_err)
  {
    $best = [];
    $cur_err = 0;
    // generate initial population
    $population = $this->generate_population();
    // function to compute fitness value
    $population = $this->fitness_value($population);
    $best = $this->get_best_time_from_current_population($population, 1);
    for ($i = 0; $i < $total_gen; $i++) {
      if ($cur_err >= $total_err) {
        break;
      }
      $population = $this->roulette_wheel_selection($population);
      $population = $this->cross_over($population, $pc);
      $population = $this->fitness_value($population);
      $cur_best_kromosom = $this->get_best_time_from_current_population($population, $i + 1);
      if ($cur_best_kromosom[1] < $best[1]) {
        $best = $cur_best_kromosom;
      }
      $population = $this->mutation($population, $pm);
      $population = $this->fitness_value($population);
      $cur_best_kromosom = $this->get_best_time_from_current_population($population, $i + 1);
      if ($cur_best_kromosom[1] > $best[1]) {
        $cur_err++;
      } else {
        $best = $cur_best_kromosom;
      }
    }
    return $best;
  }

  public function mutation($population, $pm)
  {
    for ($i = 0; $i < sizeof($population); $i++) {
      if ($pm / 100 >= mt_rand() / mt_getrandmax()) {
        $population[$i]['jadwal'] = $this->swap_mutation($population[$i]['jadwal']);
      }
    }
    return $population;
  }
  public function swap_mutation($jadwal)
  {
    $rand_num1 = rand(0, sizeof($jadwal) - 1);
    $rand_num2 = rand(0, sizeof($jadwal) - 1);
    [$jadwal[$rand_num1], $jadwal[$rand_num2]] = [$jadwal[$rand_num2], $jadwal[$rand_num1]];

    return $jadwal;
  }

  public function cross_over($population, $pc)
  {
    $parents = [];
    $loners = [];
    for ($i = 0; $i < sizeof($population); $i++) {
      if ($pc / 100 >= mt_rand() / mt_getrandmax()) {
        $parents[] = $population[$i];
      } else {
        $loners[] = $population[$i];
      }
    }
    $offsprings = $this->get_cross_over_offspring($parents);
    return array_merge($offsprings, $loners);
  }

  public function get_cross_over_offspring($parents) // bentuknya populasi yang terisi dari barisan kromosom, waktu, fitness, dll
  {
    $offsprings = [];
    for ($i = 0; $i < sizeof($parents); $i++) {
      if ($i == sizeof($parents) - 1) {
        $offsprings[$i]['jadwal'] = $this->get_cut_point_result($parents[$i]['jadwal'], $parents[0]['jadwal']);
      } else {
        $offsprings[$i]['jadwal'] = $this->get_cut_point_result($parents[$i]['jadwal'], $parents[$i + 1]['jadwal']);
      }
    }
    return $offsprings;
  }

  public function get_cut_point_result($parent1, $parent2)
  {
    $rand_num = rand(0, sizeof($parent1) - 1);
    $slice1 = array_slice($parent1, 0, $rand_num);
    $slice2 = array_slice($parent2, $rand_num, sizeof($parent2) - $rand_num);
    $offspring = array_merge($slice1, $slice2);
    if (array_count_values($offspring) == array_count_values($parent1)) {
      return $offspring;
    } else {
      shuffle($parent1);
      return $parent1;
    }
  }

  public function roulette_wheel_selection($population)
  {
    $new_population = [];
    for ($i = 0; $i < sizeof($population); $i++) {
      $new_population[] = $this->get_selection_new_population($population);
    }
    return $new_population;
  }

  public function get_selection_new_population($population)
  {
    $rand_num = mt_rand() / mt_getrandmax();
    for ($i = 0; $i < sizeof($population); $i++) {
      if ($rand_num <= $population[$i]['prob_kum']) {
        return $population[$i];
      }
    }
  }

  public function fitness_value($population)
  {
    $population = $this->get_time($population);
    $population = $this->get_fitness_value($population);
    $population = $this->get_prob_fit($population);
    $population = $this->get_prob_kum($population);

    return $population;
  }

  public function get_best_time_from_current_population($population, $gen)
  {
    $waktu = array_column($population, 'waktu');
    $min_kromosom = $population[array_search(min($waktu), $waktu)];

    return [$min_kromosom['jadwal'], $min_kromosom['waktu'], $gen];
  }

  public function generate_population()
  {
    $population = [];
    for ($i = 0; $i < 10; $i++) {
      $population[] = [
        'jadwal' => $this->generate_kromosom(),
        'waktu' => 0,
        'fitness' => 0.0,
        'prob_fit' => 0.0,
        'prob_kum' => 0.0,
      ];
    }

    return $population;
  }

  public function generate_kromosom()
  {
    $pekerjaanLineModel = new \App\Models\PekerjaanLineModel();

    $pekerjaanLine = $pekerjaanLineModel->select('pekerjaan_id')->get()->getResultArray();
    $pekerjaan_id  = [];
    foreach ($pekerjaanLine as $pl) {
      $pekerjaan_id[] = $pl['pekerjaan_id'];
    }
    shuffle($pekerjaan_id);
    return $pekerjaan_id;
  }

  public function get_prob_kum($population)
  {
    for ($i = 0; $i < sizeof($population); $i++) {
      if ($i == 0) {
        $population[$i]['prob_kum'] = $population[$i]['prob_fit'];
      } else {
        $population[$i]['prob_kum'] = $population[$i - 1]['prob_kum'] + $population[$i]['prob_fit'];
      }
    }
    return $population;
  }

  public function get_prob_fit($population)
  {
    $total_fitness = 0;
    foreach ($population as $pop) {
      $total_fitness += $pop['fitness'];
    }
    for ($i = 0; $i < sizeof($population); $i++) {
      $population[$i]['prob_fit'] = $population[$i]['fitness'] / $total_fitness;
    }
    return $population;
  }

  public function get_fitness_value($population)
  {
    $total_waktu = 0;
    foreach ($population as $pop) {
      $total_waktu += $pop['waktu'];
    }
    for ($i = 0; $i < sizeof($population); $i++) {
      $population[$i]['fitness'] = $total_waktu / $population[$i]['waktu'];
    }
    return $population;
  }

  public function get_time($population)
  {
    for ($i = 0; $i < sizeof($population); $i++) {
      $population[$i]['waktu'] = $this->compute_time($population[$i]['jadwal']);
    }

    return $population;
  }

  public function compute_time($kromosom)
  {
    $counter = [];
    $graph = $this->create_graph();
    foreach ($kromosom as $gen) {
      $counts = array_count_values($counter);
      if (in_array($gen, $counter)) {
        $sequence = $counts[$gen] + 1;
      } else {
        $sequence = 1;
      }
      $counter[] = $gen;
      $graph = $this->update_graph($graph, $gen, $sequence);
    }
    $graph = $this->compare_waktu_end($graph);
    return $graph['waktu_end'];
  }

  public function compare_waktu_end($graph)
  {
    $max_end_waktu = [];
    for ($i = 0; $i < sizeof($graph['waktu']); $i++) {
      $max_end_waktu[] = $graph['waktu'][$i][sizeof($graph['waktu'][$i]) - 1][1];
    }
    $graph['waktu_end'] = max($max_end_waktu);
    return $graph;
  }

  public function update_graph($graph, $gen, $sequence)
  {
    $pekerjaanLineModel = new \App\Models\PekerjaanLineModel();
    [$line_id, $mesin_id, $waktu] = $pekerjaanLineModel->get_by_sequence_and_job_id($gen, $sequence);
    $mesin_idx = array_search($mesin_id, $graph['mesin']);
    $size_fill = sizeof($graph['waktu'][$mesin_idx]);
    $waktu = (int)$waktu;

    if ($sequence == 1) {
      if ($size_fill == 0) {
        $graph['waktu'][$mesin_idx][] = [$line_id, $this->compute_waktu($waktu)];
      } else {
        $graph['waktu'][$mesin_idx][] =  [$line_id, $this->compute_waktu($waktu, $graph['waktu'][$mesin_idx][$size_fill - 1][1])];
      }
    } else {
      [$prev_line_id, $prev_mesin_id, $prev_waktu] = $pekerjaanLineModel->get_by_sequence_and_job_id($gen, $sequence - 1);
      $prev_mesin_idx = array_search($prev_mesin_id, $graph['mesin']);
      foreach ($graph['waktu'][$prev_mesin_idx] as $prev_mesin_arr) {
        if ($prev_line_id == $prev_mesin_arr[0]) {
          if ($size_fill == 0) {
            $graph['waktu'][$mesin_idx][] = [$line_id, $this->compute_waktu($waktu, $prev_mesin_arr[1])];
          } else {
            if ($prev_mesin_arr[1] > $graph['waktu'][$mesin_idx][$size_fill - 1][1]) {
              $graph['waktu'][$mesin_idx][] = [$line_id, $this->compute_waktu($waktu, $prev_mesin_arr[1])];
            } else {
              $graph['waktu'][$mesin_idx][] = [$line_id, $this->compute_waktu($waktu, $graph['waktu'][$mesin_idx][$size_fill - 1][1])];
            }
          }
        }
      }
    }


    return $graph;
  }

  public function compute_waktu($waktu, $waktu_lain = 0)
  {
    return $waktu + $waktu_lain;
  }

  public function get_sequence($counter, $pekerjaan_id)
  {
    // dd($counter);
    $counts = array_count_values($counter);
    if (in_array($pekerjaan_id, $counter)) {
      $count = $counts[$pekerjaan_id] + 1;
    } else {
      $count = 1;
    }
    return [$counter[] = $pekerjaan_id, $count];
  }

  public function create_graph()
  {
    $mesinModel = new \App\models\MesinModel();
    $graph = [
      'waktu_end' => 0,
      'mesin' => $mesinModel->get_id_only(),  // list of mesin_id
      'waktu' => []
    ];
    foreach ($graph['mesin'] as $mesin) {
      $graph['waktu'][] = [];
    }
    return $graph;
  }
}
