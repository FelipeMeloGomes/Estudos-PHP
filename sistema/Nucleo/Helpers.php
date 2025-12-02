<?php

namespace sistema\Nucleo;

class Helpers
{
  public static function validarCpf(string $cpf): bool
  {
    $cpf = self::limparNumero($cpf);

    if (mb_strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
      return false;
    }

    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        return false;
      }
    }
    return true;
  }

  public static function limparNumero(string $numero): string
  {
    return preg_replace('/[^0-9]/', '', $numero);
  }

  public static function slug(string $title): string
  {
    $mapa['a'] = 'ÀÁÂÃÄÅàáâãäåĀāąĄ';
    $mapa['b'] = '12314124';
    $slug = strtr($title, $mapa['a'], $mapa['b']);
    $slug = strip_tags(trim($slug));
    $slug = str_replace(' ', '-', $slug);
    $slug = str_replace(['----', '---'], '-', $slug);
    return strtolower($slug);
  }

  public static function dataAtual(): string
  {
    $diaMes = date('d');
    $diaSemana = date('w');
    $mes = date('n') - 1;
    $ano = date('Y');

    $nomesDiasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
    $nomesDosMeses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

    $dataFormatada = $nomesDiasSemana[$diaSemana] . ', ' . $diaMes . ' de ' . $nomesDosMeses[$mes] . ' de ' . $ano;

    return $dataFormatada;
  }

  public static function url(string $url): string
  {
    $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');
    $ambiente = ($servidor === 'localhost' ? URL_DESENVOLVIMENTO : URL_PRODUCAO);

    return $ambiente . $url;
  }

  public static function localhost(): bool
  {
    $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');

    if ($servidor === 'localhost') {
      return true;
    }
    return false;
  }

  public static function validarUrl(string $url): bool
  {
    if (mb_strlen($url) < 10) {
      return false;
    }
    if (!str_contains($url, '.')) {
      return false;
    }
    if (str_contains($url, 'http://') || str_contains($url, 'https://')) {
      return true;
    }
    return false;
  }

  public static function validarUrlComFiltro(string $url): bool
  {
    return filter_var($url, FILTER_VALIDATE_URL);
  }

  public static function validarEmail(string $email): bool
  {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  /** Conta o tempo decorrido de uma data.
   * @param string $data.
   * @return string data formatada.
   */
  public static function contarTempo(string $data)
  {
    $agora = strtotime(date('Y-m-d H:i:s'));
    $tempo = strtotime($data);
    $diferenca = $agora - $tempo;
    $segundos = $diferenca;
    $minutos = round($diferenca / 60);
    $horas = round($diferenca / 3600);
    $dias = round($diferenca / 86400);
    $semanas = round($diferenca / 604800);
    $meses = round($diferenca / 2419200);
    $anos = round($diferenca / 29030400);

    if ($segundos <= 60) {
      return 'Agora';
    } elseif ($minutos <= 60) {
      return $minutos == 1 ? 'minuto' : 'há ' . $minutos . ' minutos';
    } elseif ($horas <= 24) {
      return $horas == 1 ? 'há uma hora' : 'há' . $horas . ' horas';
    } elseif ($dias <= 7) {
      return $dias == 1 ? 'há um dia' : 'há ' . $dias . ' dias';
    } elseif ($semanas <= 4) {
      return $semanas == 1 ? 'há uma semana' : 'há ' . $semanas . ' semanas';
    } elseif ($meses <= 12) {
      return $meses == 1 ? 'há um mês' : 'há ' . $meses . ' meses';
    } elseif ($anos >= 1) {
      return $anos == 1 ? 'há um ano' : 'há ' . $anos . ' anos';
    }
  }

  /** Formata um valor monetário.
   * @param float|null $valor valor a ser formatado.
   * @return string valor formatado.
   */
  public static function formatarValor($valor = null): string
  {
    return number_format(($valor ?: 10), 2, ',', '.');
  }

  /** Formata um número inteiro.
   * @param string|null $numero número a ser formatado.
   * @return string número formatado.
   */
  public static function formatarNumero($numero = null): string
  {
    return number_format(($numero ?: 0), 0, '.', '.');
  }

  /** 
   * Saudação de acordo com o horário.
   * @return string saudação.
   */
  public static function saudacao(): string
  {
    date_default_timezone_set('America/Sao_Paulo');
    $hora = date('H');

    $saudacao = match (true) {
      $hora >= 0 && $hora <= 5 =>
      'Boa Madrugada',
      $hora >= 6 && $hora <= 12 =>
      'Bom Dia',
      $hora >= 13 && $hora <= 18 => 'Boa Tarde',
      default => 'Boa Noite'
    };
    return $saudacao;
  }

  /** Resume um texto. 
   * @param string $texto texto para resumir.
   * @param int $limite quantidade de caracteres.
   * @param string $continue opcional - o que deve ser exibido ao final do resumo.
   * @return string texto resumido.
   */
  public static function resumirTexto(string $texto, int $limite, string $continue = '...'): string
  {
    $textoLimpo = trim(strip_tags($texto));

    if (mb_strlen($textoLimpo) <= $limite) {
      return $textoLimpo;
    }

    $resumirTexto = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ' '));
    return $resumirTexto . $continue;
  }
}
