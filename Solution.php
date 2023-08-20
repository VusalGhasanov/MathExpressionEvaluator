<?php

class Solution
{
    /**
     * @var int[]
     */
    private $precedence = [
        '+' => 1,
        '-' => 1,
        '*' => 2,
        '/' => 2,
        '^' => 3,
    ];

    /**
     * calculate
     *
     * @param string $expression
     * @return false|mixed
     */
    public function calculate(string $expression)
    {
        $expression = str_replace(' ', '', $expression);

        $operators = [];
        $operands = [];

        $tokens = str_split($expression);

        foreach ($tokens as $token) {
            if (is_numeric($token)) {
                $operands[] = $token;
            } elseif ($token === '(') {
                $operators[] = $token;
            } elseif ($token === ')') {
                while (!empty($operators) && end($operators) !== '(') {
                    $operands[] = array_pop($operators);
                }
                array_pop($operators);
            } elseif (array_key_exists($token, $this->precedence)) {
                while (!empty($operators) && array_key_exists(end($operators), $this->precedence) &&
                    $this->precedence[end($operators)] >= $this->precedence[$token]) {
                    $operands[] = array_pop($operators);
                }
                $operators[] = $token;
            }
        }

        while (!empty($operators)) {
            $operands[] = array_pop($operators);
        }

        $stack = [];
        foreach ($operands as $token) {
            if (is_numeric($token)) {
                $stack[] = $token;
            } else {
                $operand2 = array_pop($stack);
                $operand1 = array_pop($stack);

                switch ($token) {
                    case '+':
                        $stack[] = $operand1 + $operand2;
                        break;
                    case '-':
                        $stack[] = $operand1 - $operand2;
                        break;
                    case '*':
                        $stack[] = $operand1 * $operand2;
                        break;
                    case '/':
                        $stack[] = $operand1 / $operand2;
                        break;
                    case '^':
                        $stack[] = pow($operand1, $operand2);
                        break;
                }
            }
        }

        return end($stack);
    }
}
