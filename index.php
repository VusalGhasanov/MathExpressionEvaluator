<?php

require_once "./Solution.php";

$expressionEvaluator = new Solution();

$mathExpression = "2 + 3 * 4";
$result = $expressionEvaluator->calculate($mathExpression);
echo "Result: $result";
