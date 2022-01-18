

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '<ul><li data-name="namespace:Tailors" class="opened"><div style="padding-left:0px" class="hd"><span class="icon icon-play"></span><a href="Tailors.html">Tailors</a></div><div class="bd"><ul><li data-name="namespace:Tailors_Logic" class="opened"><div style="padding-left:18px" class="hd"><span class="icon icon-play"></span><a href="Tailors/Logic.html">Logic</a></div><div class="bd"><ul><li data-name="namespace:Tailors_Logic_Connectives" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Tailors/Logic/Connectives.html">Connectives</a></div><div class="bd"><ul><li data-name="class:Tailors_Logic_Connectives_BasicConnectivesInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Connectives/BasicConnectivesInterface.html">BasicConnectivesInterface</a></div></li><li data-name="class:Tailors_Logic_Connectives_BasicConnectivesTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Connectives/BasicConnectivesTrait.html">BasicConnectivesTrait</a></div></li><li data-name="class:Tailors_Logic_Connectives_BinaryConnectiveTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Connectives/BinaryConnectiveTrait.html">BinaryConnectiveTrait</a></div></li><li data-name="class:Tailors_Logic_Connectives_Conjunction" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Connectives/Conjunction.html">Conjunction</a></div></li><li data-name="class:Tailors_Logic_Connectives_ConnectiveFormula" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Connectives/ConnectiveFormula.html">ConnectiveFormula</a></div></li><li data-name="class:Tailors_Logic_Connectives_ConnectiveInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Connectives/ConnectiveInterface.html">ConnectiveInterface</a></div></li><li data-name="class:Tailors_Logic_Connectives_Disjunction" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Connectives/Disjunction.html">Disjunction</a></div></li><li data-name="class:Tailors_Logic_Connectives_UnaryConnectiveTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Connectives/UnaryConnectiveTrait.html">UnaryConnectiveTrait</a></div></li></ul></div></li><li data-name="namespace:Tailors_Logic_Exceptions" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Tailors/Logic/Exceptions.html">Exceptions</a></div><div class="bd"><ul><li data-name="class:Tailors_Logic_Exceptions_InvalidArgumentException" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Exceptions/InvalidArgumentException.html">InvalidArgumentException</a></div></li></ul></div></li><li data-name="namespace:Tailors_Logic_Functions" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Tailors/Logic/Functions.html">Functions</a></div><div class="bd"><ul><li data-name="class:Tailors_Logic_Functions_AbstractFunction" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/AbstractFunction.html">AbstractFunction</a></div></li><li data-name="class:Tailors_Logic_Functions_AbstractNumericFunction" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/AbstractNumericFunction.html">AbstractNumericFunction</a></div></li><li data-name="class:Tailors_Logic_Functions_BasicFunctionsInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/BasicFunctionsInterface.html">BasicFunctionsInterface</a></div></li><li data-name="class:Tailors_Logic_Functions_BasicFunctionsTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/BasicFunctionsTrait.html">BasicFunctionsTrait</a></div></li><li data-name="class:Tailors_Logic_Functions_BinaryFunctionTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/BinaryFunctionTrait.html">BinaryFunctionTrait</a></div></li><li data-name="class:Tailors_Logic_Functions_Constant" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/Constant.html">Constant</a></div></li><li data-name="class:Tailors_Logic_Functions_FunctionInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/FunctionInterface.html">FunctionInterface</a></div></li><li data-name="class:Tailors_Logic_Functions_FunctionTerm" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/FunctionTerm.html">FunctionTerm</a></div></li><li data-name="class:Tailors_Logic_Functions_Sub" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/Sub.html">Sub</a></div></li><li data-name="class:Tailors_Logic_Functions_Sum" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/Sum.html">Sum</a></div></li><li data-name="class:Tailors_Logic_Functions_UnaryFunctionTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Functions/UnaryFunctionTrait.html">UnaryFunctionTrait</a></div></li></ul></div></li><li data-name="namespace:Tailors_Logic_Predicates" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Tailors/Logic/Predicates.html">Predicates</a></div><div class="bd"><ul><li data-name="class:Tailors_Logic_Predicates_AbstractPredicate" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Predicates/AbstractPredicate.html">AbstractPredicate</a></div></li><li data-name="class:Tailors_Logic_Predicates_BasicPredicatesInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Predicates/BasicPredicatesInterface.html">BasicPredicatesInterface</a></div></li><li data-name="class:Tailors_Logic_Predicates_BasicPredicatesTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Predicates/BasicPredicatesTrait.html">BasicPredicatesTrait</a></div></li><li data-name="class:Tailors_Logic_Predicates_BinaryPredicateTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Predicates/BinaryPredicateTrait.html">BinaryPredicateTrait</a></div></li><li data-name="class:Tailors_Logic_Predicates_Falsum" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Predicates/Falsum.html">Falsum</a></div></li><li data-name="class:Tailors_Logic_Predicates_PredicateFormula" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Predicates/PredicateFormula.html">PredicateFormula</a></div></li><li data-name="class:Tailors_Logic_Predicates_PredicateInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Predicates/PredicateInterface.html">PredicateInterface</a></div></li><li data-name="class:Tailors_Logic_Predicates_Tee" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Predicates/Tee.html">Tee</a></div></li><li data-name="class:Tailors_Logic_Predicates_UnaryPredicateTrait" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Predicates/UnaryPredicateTrait.html">UnaryPredicateTrait</a></div></li></ul></div></li><li data-name="namespace:Tailors_Logic_Validators" ><div style="padding-left:36px" class="hd"><span class="icon icon-play"></span><a href="Tailors/Logic/Validators.html">Validators</a></div><div class="bd"><ul><li data-name="class:Tailors_Logic_Validators_AbstractArglistValidator" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Validators/AbstractArglistValidator.html">AbstractArglistValidator</a></div></li><li data-name="class:Tailors_Logic_Validators_ArglistValidatorInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Validators/ArglistValidatorInterface.html">ArglistValidatorInterface</a></div></li><li data-name="class:Tailors_Logic_Validators_BasicValidators" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Validators/BasicValidators.html">BasicValidators</a></div></li><li data-name="class:Tailors_Logic_Validators_BasicValidatorsInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Validators/BasicValidatorsInterface.html">BasicValidatorsInterface</a></div></li><li data-name="class:Tailors_Logic_Validators_ComparatorArglistValidator" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Validators/ComparatorArglistValidator.html">ComparatorArglistValidator</a></div></li><li data-name="class:Tailors_Logic_Validators_ComparatorArglistValidatorInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Validators/ComparatorArglistValidatorInterface.html">ComparatorArglistValidatorInterface</a></div></li><li data-name="class:Tailors_Logic_Validators_NumbersArglistValidator" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Validators/NumbersArglistValidator.html">NumbersArglistValidator</a></div></li><li data-name="class:Tailors_Logic_Validators_NumbersArglistValidatorInterface" ><div style="padding-left:62px" class="hd leaf"><a href="Tailors/Logic/Validators/NumbersArglistValidatorInterface.html">NumbersArglistValidatorInterface</a></div></li></ul></div></li><li data-name="class:Tailors_Logic_ExpressionInterface" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/ExpressionInterface.html">ExpressionInterface</a></div></li><li data-name="class:Tailors_Logic_FormulaInterface" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/FormulaInterface.html">FormulaInterface</a></div></li><li data-name="class:Tailors_Logic_FunctionalExpressionInterface" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/FunctionalExpressionInterface.html">FunctionalExpressionInterface</a></div></li><li data-name="class:Tailors_Logic_FunctionalExpressionTrait" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/FunctionalExpressionTrait.html">FunctionalExpressionTrait</a></div></li><li data-name="class:Tailors_Logic_FunctionalInterface" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/FunctionalInterface.html">FunctionalInterface</a></div></li><li data-name="class:Tailors_Logic_InfixNotationTrait" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/InfixNotationTrait.html">InfixNotationTrait</a></div></li><li data-name="class:Tailors_Logic_Logic" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/Logic.html">Logic</a></div></li><li data-name="class:Tailors_Logic_LogicInterface" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/LogicInterface.html">LogicInterface</a></div></li><li data-name="class:Tailors_Logic_PrefixNotationTrait" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/PrefixNotationTrait.html">PrefixNotationTrait</a></div></li><li data-name="class:Tailors_Logic_SuffixNotationTrait" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/SuffixNotationTrait.html">SuffixNotationTrait</a></div></li><li data-name="class:Tailors_Logic_SymbolInterface" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/SymbolInterface.html">SymbolInterface</a></div></li><li data-name="class:Tailors_Logic_SymbolNotationTrait" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/SymbolNotationTrait.html">SymbolNotationTrait</a></div></li><li data-name="class:Tailors_Logic_TermInterface" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/TermInterface.html">TermInterface</a></div></li><li data-name="class:Tailors_Logic_Variable" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/Variable.html">Variable</a></div></li><li data-name="class:Tailors_Logic_VariableInterface" ><div style="padding-left:44px" class="hd leaf"><a href="Tailors/Logic/VariableInterface.html">VariableInterface</a></div></li></ul></div></li></ul></div></li></ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                        {"type":"Namespace","link":"Tailors.html","name":"Tailors","doc":"Namespace Tailors"},{"type":"Namespace","link":"Tailors/Logic.html","name":"Tailors\\Logic","doc":"Namespace Tailors\\Logic"},{"type":"Namespace","link":"Tailors/Logic/Connectives.html","name":"Tailors\\Logic\\Connectives","doc":"Namespace Tailors\\Logic\\Connectives"},{"type":"Namespace","link":"Tailors/Logic/Exceptions.html","name":"Tailors\\Logic\\Exceptions","doc":"Namespace Tailors\\Logic\\Exceptions"},{"type":"Namespace","link":"Tailors/Logic/Functions.html","name":"Tailors\\Logic\\Functions","doc":"Namespace Tailors\\Logic\\Functions"},{"type":"Namespace","link":"Tailors/Logic/Predicates.html","name":"Tailors\\Logic\\Predicates","doc":"Namespace Tailors\\Logic\\Predicates"},{"type":"Namespace","link":"Tailors/Logic/Validators.html","name":"Tailors\\Logic\\Validators","doc":"Namespace Tailors\\Logic\\Validators"},                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/BasicConnectivesInterface.html","name":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface","fromLink":"Tailors/Logic/Connectives/BasicConnectivesInterface.html","link":"Tailors/Logic/Connectives/BasicConnectivesInterface.html#method_and","name":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface::and","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface","fromLink":"Tailors/Logic/Connectives/BasicConnectivesInterface.html","link":"Tailors/Logic/Connectives/BasicConnectivesInterface.html#method_or","name":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface::or","doc":null},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/ConnectiveInterface.html","name":"Tailors\\Logic\\Connectives\\ConnectiveInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\ConnectiveInterface","fromLink":"Tailors/Logic/Connectives/ConnectiveInterface.html","link":"Tailors/Logic/Connectives/ConnectiveInterface.html#method_apply","name":"Tailors\\Logic\\Connectives\\ConnectiveInterface::apply","doc":null},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/ExpressionInterface.html","name":"Tailors\\Logic\\ExpressionInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\ExpressionInterface","fromLink":"Tailors/Logic/ExpressionInterface.html","link":"Tailors/Logic/ExpressionInterface.html#method_expressionString","name":"Tailors\\Logic\\ExpressionInterface::expressionString","doc":null},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/FormulaInterface.html","name":"Tailors\\Logic\\FormulaInterface","doc":""},
                
                                                 {"type":"Interface","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/FunctionalExpressionInterface.html","name":"Tailors\\Logic\\FunctionalExpressionInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\FunctionalExpressionInterface","fromLink":"Tailors/Logic/FunctionalExpressionInterface.html","link":"Tailors/Logic/FunctionalExpressionInterface.html#method_arguments","name":"Tailors\\Logic\\FunctionalExpressionInterface::arguments","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\FunctionalExpressionInterface","fromLink":"Tailors/Logic/FunctionalExpressionInterface.html","link":"Tailors/Logic/FunctionalExpressionInterface.html#method_functional","name":"Tailors\\Logic\\FunctionalExpressionInterface::functional","doc":null},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/FunctionalInterface.html","name":"Tailors\\Logic\\FunctionalInterface","doc":"Either a function or a predicate."},
                                {"type":"Method","fromName":"Tailors\\Logic\\FunctionalInterface","fromLink":"Tailors/Logic/FunctionalInterface.html","link":"Tailors/Logic/FunctionalInterface.html#method_arity","name":"Tailors\\Logic\\FunctionalInterface::arity","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\FunctionalInterface","fromLink":"Tailors/Logic/FunctionalInterface.html","link":"Tailors/Logic/FunctionalInterface.html#method_notation","name":"Tailors\\Logic\\FunctionalInterface::notation","doc":""},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/BasicFunctionsInterface.html","name":"Tailors\\Logic\\Functions\\BasicFunctionsInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsInterface","fromLink":"Tailors/Logic/Functions/BasicFunctionsInterface.html","link":"Tailors/Logic/Functions/BasicFunctionsInterface.html#method_const","name":"Tailors\\Logic\\Functions\\BasicFunctionsInterface::const","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsInterface","fromLink":"Tailors/Logic/Functions/BasicFunctionsInterface.html","link":"Tailors/Logic/Functions/BasicFunctionsInterface.html#method_sub","name":"Tailors\\Logic\\Functions\\BasicFunctionsInterface::sub","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsInterface","fromLink":"Tailors/Logic/Functions/BasicFunctionsInterface.html","link":"Tailors/Logic/Functions/BasicFunctionsInterface.html#method_sum","name":"Tailors\\Logic\\Functions\\BasicFunctionsInterface::sum","doc":null},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/FunctionInterface.html","name":"Tailors\\Logic\\Functions\\FunctionInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\FunctionInterface","fromLink":"Tailors/Logic/Functions/FunctionInterface.html","link":"Tailors/Logic/Functions/FunctionInterface.html#method_apply","name":"Tailors\\Logic\\Functions\\FunctionInterface::apply","doc":""},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/LogicInterface.html","name":"Tailors\\Logic\\LogicInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\LogicInterface","fromLink":"Tailors/Logic/LogicInterface.html","link":"Tailors/Logic/LogicInterface.html#method_var","name":"Tailors\\Logic\\LogicInterface::var","doc":""},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/BasicPredicatesInterface.html","name":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface","fromLink":"Tailors/Logic/Predicates/BasicPredicatesInterface.html","link":"Tailors/Logic/Predicates/BasicPredicatesInterface.html#method_tee","name":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface::tee","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface","fromLink":"Tailors/Logic/Predicates/BasicPredicatesInterface.html","link":"Tailors/Logic/Predicates/BasicPredicatesInterface.html#method_falsum","name":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface::falsum","doc":null},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/PredicateInterface.html","name":"Tailors\\Logic\\Predicates\\PredicateInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\PredicateInterface","fromLink":"Tailors/Logic/Predicates/PredicateInterface.html","link":"Tailors/Logic/Predicates/PredicateInterface.html#method_apply","name":"Tailors\\Logic\\Predicates\\PredicateInterface::apply","doc":""},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/SymbolInterface.html","name":"Tailors\\Logic\\SymbolInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\SymbolInterface","fromLink":"Tailors/Logic/SymbolInterface.html","link":"Tailors/Logic/SymbolInterface.html#method_symbol","name":"Tailors\\Logic\\SymbolInterface::symbol","doc":null},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/TermInterface.html","name":"Tailors\\Logic\\TermInterface","doc":""},
                
                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/ArglistValidatorInterface.html","name":"Tailors\\Logic\\Validators\\ArglistValidatorInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Validators\\ArglistValidatorInterface","fromLink":"Tailors/Logic/Validators/ArglistValidatorInterface.html","link":"Tailors/Logic/Validators/ArglistValidatorInterface.html#method_validate","name":"Tailors\\Logic\\Validators\\ArglistValidatorInterface::validate","doc":""},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/BasicValidatorsInterface.html","name":"Tailors\\Logic\\Validators\\BasicValidatorsInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Validators\\BasicValidatorsInterface","fromLink":"Tailors/Logic/Validators/BasicValidatorsInterface.html","link":"Tailors/Logic/Validators/BasicValidatorsInterface.html#method_comparatorArglist","name":"Tailors\\Logic\\Validators\\BasicValidatorsInterface::comparatorArglist","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\BasicValidatorsInterface","fromLink":"Tailors/Logic/Validators/BasicValidatorsInterface.html","link":"Tailors/Logic/Validators/BasicValidatorsInterface.html#method_numbersArglist","name":"Tailors\\Logic\\Validators\\BasicValidatorsInterface::numbersArglist","doc":null},
            
                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/ComparatorArglistValidatorInterface.html","name":"Tailors\\Logic\\Validators\\ComparatorArglistValidatorInterface","doc":""},
                
                                                 {"type":"Interface","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/NumbersArglistValidatorInterface.html","name":"Tailors\\Logic\\Validators\\NumbersArglistValidatorInterface","doc":""},
                
                                                 {"type":"Interface","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/VariableInterface.html","name":"Tailors\\Logic\\VariableInterface","doc":""},
                
                                                        {"type":"Class","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/BasicConnectivesInterface.html","name":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface","fromLink":"Tailors/Logic/Connectives/BasicConnectivesInterface.html","link":"Tailors/Logic/Connectives/BasicConnectivesInterface.html#method_and","name":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface::and","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface","fromLink":"Tailors/Logic/Connectives/BasicConnectivesInterface.html","link":"Tailors/Logic/Connectives/BasicConnectivesInterface.html#method_or","name":"Tailors\\Logic\\Connectives\\BasicConnectivesInterface::or","doc":null},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/BasicConnectivesTrait.html","name":"Tailors\\Logic\\Connectives\\BasicConnectivesTrait","doc":"Example usage."},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\BasicConnectivesTrait","fromLink":"Tailors/Logic/Connectives/BasicConnectivesTrait.html","link":"Tailors/Logic/Connectives/BasicConnectivesTrait.html#method_and","name":"Tailors\\Logic\\Connectives\\BasicConnectivesTrait::and","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\BasicConnectivesTrait","fromLink":"Tailors/Logic/Connectives/BasicConnectivesTrait.html","link":"Tailors/Logic/Connectives/BasicConnectivesTrait.html#method_or","name":"Tailors\\Logic\\Connectives\\BasicConnectivesTrait::or","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\BasicConnectivesTrait","fromLink":"Tailors/Logic/Connectives/BasicConnectivesTrait.html","link":"Tailors/Logic/Connectives/BasicConnectivesTrait.html#method_makeBasicConnectives","name":"Tailors\\Logic\\Connectives\\BasicConnectivesTrait::makeBasicConnectives","doc":""},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/BinaryConnectiveTrait.html","name":"Tailors\\Logic\\Connectives\\BinaryConnectiveTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\BinaryConnectiveTrait","fromLink":"Tailors/Logic/Connectives/BinaryConnectiveTrait.html","link":"Tailors/Logic/Connectives/BinaryConnectiveTrait.html#method_with","name":"Tailors\\Logic\\Connectives\\BinaryConnectiveTrait::with","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\BinaryConnectiveTrait","fromLink":"Tailors/Logic/Connectives/BinaryConnectiveTrait.html","link":"Tailors/Logic/Connectives/BinaryConnectiveTrait.html#method_arity","name":"Tailors\\Logic\\Connectives\\BinaryConnectiveTrait::arity","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/Conjunction.html","name":"Tailors\\Logic\\Connectives\\Conjunction","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\Conjunction","fromLink":"Tailors/Logic/Connectives/Conjunction.html","link":"Tailors/Logic/Connectives/Conjunction.html#method_symbol","name":"Tailors\\Logic\\Connectives\\Conjunction::symbol","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\Conjunction","fromLink":"Tailors/Logic/Connectives/Conjunction.html","link":"Tailors/Logic/Connectives/Conjunction.html#method_apply","name":"Tailors\\Logic\\Connectives\\Conjunction::apply","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/ConnectiveFormula.html","name":"Tailors\\Logic\\Connectives\\ConnectiveFormula","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\ConnectiveFormula","fromLink":"Tailors/Logic/Connectives/ConnectiveFormula.html","link":"Tailors/Logic/Connectives/ConnectiveFormula.html#method___construct","name":"Tailors\\Logic\\Connectives\\ConnectiveFormula::__construct","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\ConnectiveFormula","fromLink":"Tailors/Logic/Connectives/ConnectiveFormula.html","link":"Tailors/Logic/Connectives/ConnectiveFormula.html#method_connective","name":"Tailors\\Logic\\Connectives\\ConnectiveFormula::connective","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/ConnectiveInterface.html","name":"Tailors\\Logic\\Connectives\\ConnectiveInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\ConnectiveInterface","fromLink":"Tailors/Logic/Connectives/ConnectiveInterface.html","link":"Tailors/Logic/Connectives/ConnectiveInterface.html#method_apply","name":"Tailors\\Logic\\Connectives\\ConnectiveInterface::apply","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/Disjunction.html","name":"Tailors\\Logic\\Connectives\\Disjunction","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\Disjunction","fromLink":"Tailors/Logic/Connectives/Disjunction.html","link":"Tailors/Logic/Connectives/Disjunction.html#method_symbol","name":"Tailors\\Logic\\Connectives\\Disjunction::symbol","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\Disjunction","fromLink":"Tailors/Logic/Connectives/Disjunction.html","link":"Tailors/Logic/Connectives/Disjunction.html#method_apply","name":"Tailors\\Logic\\Connectives\\Disjunction::apply","doc":null},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic\\Connectives","fromLink":"Tailors/Logic/Connectives.html","link":"Tailors/Logic/Connectives/UnaryConnectiveTrait.html","name":"Tailors\\Logic\\Connectives\\UnaryConnectiveTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\UnaryConnectiveTrait","fromLink":"Tailors/Logic/Connectives/UnaryConnectiveTrait.html","link":"Tailors/Logic/Connectives/UnaryConnectiveTrait.html#method_with","name":"Tailors\\Logic\\Connectives\\UnaryConnectiveTrait::with","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Connectives\\UnaryConnectiveTrait","fromLink":"Tailors/Logic/Connectives/UnaryConnectiveTrait.html","link":"Tailors/Logic/Connectives/UnaryConnectiveTrait.html#method_arity","name":"Tailors\\Logic\\Connectives\\UnaryConnectiveTrait::arity","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Exceptions","fromLink":"Tailors/Logic/Exceptions.html","link":"Tailors/Logic/Exceptions/InvalidArgumentException.html","name":"Tailors\\Logic\\Exceptions\\InvalidArgumentException","doc":null},
                
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/ExpressionInterface.html","name":"Tailors\\Logic\\ExpressionInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\ExpressionInterface","fromLink":"Tailors/Logic/ExpressionInterface.html","link":"Tailors/Logic/ExpressionInterface.html#method_expressionString","name":"Tailors\\Logic\\ExpressionInterface::expressionString","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/FormulaInterface.html","name":"Tailors\\Logic\\FormulaInterface","doc":""},
                
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/FunctionalExpressionInterface.html","name":"Tailors\\Logic\\FunctionalExpressionInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\FunctionalExpressionInterface","fromLink":"Tailors/Logic/FunctionalExpressionInterface.html","link":"Tailors/Logic/FunctionalExpressionInterface.html#method_arguments","name":"Tailors\\Logic\\FunctionalExpressionInterface::arguments","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\FunctionalExpressionInterface","fromLink":"Tailors/Logic/FunctionalExpressionInterface.html","link":"Tailors/Logic/FunctionalExpressionInterface.html#method_functional","name":"Tailors\\Logic\\FunctionalExpressionInterface::functional","doc":null},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/FunctionalExpressionTrait.html","name":"Tailors\\Logic\\FunctionalExpressionTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\FunctionalExpressionTrait","fromLink":"Tailors/Logic/FunctionalExpressionTrait.html","link":"Tailors/Logic/FunctionalExpressionTrait.html#method_arguments","name":"Tailors\\Logic\\FunctionalExpressionTrait::arguments","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\FunctionalExpressionTrait","fromLink":"Tailors/Logic/FunctionalExpressionTrait.html","link":"Tailors/Logic/FunctionalExpressionTrait.html#method_functional","name":"Tailors\\Logic\\FunctionalExpressionTrait::functional","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\FunctionalExpressionTrait","fromLink":"Tailors/Logic/FunctionalExpressionTrait.html","link":"Tailors/Logic/FunctionalExpressionTrait.html#method_expressionString","name":"Tailors\\Logic\\FunctionalExpressionTrait::expressionString","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/FunctionalInterface.html","name":"Tailors\\Logic\\FunctionalInterface","doc":"Either a function or a predicate."},
                                {"type":"Method","fromName":"Tailors\\Logic\\FunctionalInterface","fromLink":"Tailors/Logic/FunctionalInterface.html","link":"Tailors/Logic/FunctionalInterface.html#method_arity","name":"Tailors\\Logic\\FunctionalInterface::arity","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\FunctionalInterface","fromLink":"Tailors/Logic/FunctionalInterface.html","link":"Tailors/Logic/FunctionalInterface.html#method_notation","name":"Tailors\\Logic\\FunctionalInterface::notation","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/AbstractFunction.html","name":"Tailors\\Logic\\Functions\\AbstractFunction","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\AbstractFunction","fromLink":"Tailors/Logic/Functions/AbstractFunction.html","link":"Tailors/Logic/Functions/AbstractFunction.html#method_apply","name":"Tailors\\Logic\\Functions\\AbstractFunction::apply","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\AbstractFunction","fromLink":"Tailors/Logic/Functions/AbstractFunction.html","link":"Tailors/Logic/Functions/AbstractFunction.html#method_applyImpl","name":"Tailors\\Logic\\Functions\\AbstractFunction::applyImpl","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\AbstractFunction","fromLink":"Tailors/Logic/Functions/AbstractFunction.html","link":"Tailors/Logic/Functions/AbstractFunction.html#method_validate","name":"Tailors\\Logic\\Functions\\AbstractFunction::validate","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/AbstractNumericFunction.html","name":"Tailors\\Logic\\Functions\\AbstractNumericFunction","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\AbstractNumericFunction","fromLink":"Tailors/Logic/Functions/AbstractNumericFunction.html","link":"Tailors/Logic/Functions/AbstractNumericFunction.html#method___construct","name":"Tailors\\Logic\\Functions\\AbstractNumericFunction::__construct","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\AbstractNumericFunction","fromLink":"Tailors/Logic/Functions/AbstractNumericFunction.html","link":"Tailors/Logic/Functions/AbstractNumericFunction.html#method_validate","name":"Tailors\\Logic\\Functions\\AbstractNumericFunction::validate","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/BasicFunctionsInterface.html","name":"Tailors\\Logic\\Functions\\BasicFunctionsInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsInterface","fromLink":"Tailors/Logic/Functions/BasicFunctionsInterface.html","link":"Tailors/Logic/Functions/BasicFunctionsInterface.html#method_const","name":"Tailors\\Logic\\Functions\\BasicFunctionsInterface::const","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsInterface","fromLink":"Tailors/Logic/Functions/BasicFunctionsInterface.html","link":"Tailors/Logic/Functions/BasicFunctionsInterface.html#method_sub","name":"Tailors\\Logic\\Functions\\BasicFunctionsInterface::sub","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsInterface","fromLink":"Tailors/Logic/Functions/BasicFunctionsInterface.html","link":"Tailors/Logic/Functions/BasicFunctionsInterface.html#method_sum","name":"Tailors\\Logic\\Functions\\BasicFunctionsInterface::sum","doc":null},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/BasicFunctionsTrait.html","name":"Tailors\\Logic\\Functions\\BasicFunctionsTrait","doc":"Example usage."},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsTrait","fromLink":"Tailors/Logic/Functions/BasicFunctionsTrait.html","link":"Tailors/Logic/Functions/BasicFunctionsTrait.html#method_const","name":"Tailors\\Logic\\Functions\\BasicFunctionsTrait::const","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsTrait","fromLink":"Tailors/Logic/Functions/BasicFunctionsTrait.html","link":"Tailors/Logic/Functions/BasicFunctionsTrait.html#method_sub","name":"Tailors\\Logic\\Functions\\BasicFunctionsTrait::sub","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsTrait","fromLink":"Tailors/Logic/Functions/BasicFunctionsTrait.html","link":"Tailors/Logic/Functions/BasicFunctionsTrait.html#method_sum","name":"Tailors\\Logic\\Functions\\BasicFunctionsTrait::sum","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BasicFunctionsTrait","fromLink":"Tailors/Logic/Functions/BasicFunctionsTrait.html","link":"Tailors/Logic/Functions/BasicFunctionsTrait.html#method_makeBasicFunctions","name":"Tailors\\Logic\\Functions\\BasicFunctionsTrait::makeBasicFunctions","doc":""},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/BinaryFunctionTrait.html","name":"Tailors\\Logic\\Functions\\BinaryFunctionTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BinaryFunctionTrait","fromLink":"Tailors/Logic/Functions/BinaryFunctionTrait.html","link":"Tailors/Logic/Functions/BinaryFunctionTrait.html#method_with","name":"Tailors\\Logic\\Functions\\BinaryFunctionTrait::with","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\BinaryFunctionTrait","fromLink":"Tailors/Logic/Functions/BinaryFunctionTrait.html","link":"Tailors/Logic/Functions/BinaryFunctionTrait.html#method_arity","name":"Tailors\\Logic\\Functions\\BinaryFunctionTrait::arity","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/Constant.html","name":"Tailors\\Logic\\Functions\\Constant","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\Constant","fromLink":"Tailors/Logic/Functions/Constant.html","link":"Tailors/Logic/Functions/Constant.html#method___construct","name":"Tailors\\Logic\\Functions\\Constant::__construct","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\Constant","fromLink":"Tailors/Logic/Functions/Constant.html","link":"Tailors/Logic/Functions/Constant.html#method_arity","name":"Tailors\\Logic\\Functions\\Constant::arity","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\Constant","fromLink":"Tailors/Logic/Functions/Constant.html","link":"Tailors/Logic/Functions/Constant.html#method_apply","name":"Tailors\\Logic\\Functions\\Constant::apply","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\Constant","fromLink":"Tailors/Logic/Functions/Constant.html","link":"Tailors/Logic/Functions/Constant.html#method_symbol","name":"Tailors\\Logic\\Functions\\Constant::symbol","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\Constant","fromLink":"Tailors/Logic/Functions/Constant.html","link":"Tailors/Logic/Functions/Constant.html#method_expressionString","name":"Tailors\\Logic\\Functions\\Constant::expressionString","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/FunctionInterface.html","name":"Tailors\\Logic\\Functions\\FunctionInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\FunctionInterface","fromLink":"Tailors/Logic/Functions/FunctionInterface.html","link":"Tailors/Logic/Functions/FunctionInterface.html#method_apply","name":"Tailors\\Logic\\Functions\\FunctionInterface::apply","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/FunctionTerm.html","name":"Tailors\\Logic\\Functions\\FunctionTerm","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\FunctionTerm","fromLink":"Tailors/Logic/Functions/FunctionTerm.html","link":"Tailors/Logic/Functions/FunctionTerm.html#method___construct","name":"Tailors\\Logic\\Functions\\FunctionTerm::__construct","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\FunctionTerm","fromLink":"Tailors/Logic/Functions/FunctionTerm.html","link":"Tailors/Logic/Functions/FunctionTerm.html#method_function","name":"Tailors\\Logic\\Functions\\FunctionTerm::function","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/Sub.html","name":"Tailors\\Logic\\Functions\\Sub","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\Sub","fromLink":"Tailors/Logic/Functions/Sub.html","link":"Tailors/Logic/Functions/Sub.html#method_symbol","name":"Tailors\\Logic\\Functions\\Sub::symbol","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\Sub","fromLink":"Tailors/Logic/Functions/Sub.html","link":"Tailors/Logic/Functions/Sub.html#method_applyImpl","name":"Tailors\\Logic\\Functions\\Sub::applyImpl","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/Sum.html","name":"Tailors\\Logic\\Functions\\Sum","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\Sum","fromLink":"Tailors/Logic/Functions/Sum.html","link":"Tailors/Logic/Functions/Sum.html#method_symbol","name":"Tailors\\Logic\\Functions\\Sum::symbol","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\Sum","fromLink":"Tailors/Logic/Functions/Sum.html","link":"Tailors/Logic/Functions/Sum.html#method_applyImpl","name":"Tailors\\Logic\\Functions\\Sum::applyImpl","doc":""},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic\\Functions","fromLink":"Tailors/Logic/Functions.html","link":"Tailors/Logic/Functions/UnaryFunctionTrait.html","name":"Tailors\\Logic\\Functions\\UnaryFunctionTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Functions\\UnaryFunctionTrait","fromLink":"Tailors/Logic/Functions/UnaryFunctionTrait.html","link":"Tailors/Logic/Functions/UnaryFunctionTrait.html#method_with","name":"Tailors\\Logic\\Functions\\UnaryFunctionTrait::with","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Functions\\UnaryFunctionTrait","fromLink":"Tailors/Logic/Functions/UnaryFunctionTrait.html","link":"Tailors/Logic/Functions/UnaryFunctionTrait.html#method_arity","name":"Tailors\\Logic\\Functions\\UnaryFunctionTrait::arity","doc":""},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/InfixNotationTrait.html","name":"Tailors\\Logic\\InfixNotationTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\InfixNotationTrait","fromLink":"Tailors/Logic/InfixNotationTrait.html","link":"Tailors/Logic/InfixNotationTrait.html#method_notation","name":"Tailors\\Logic\\InfixNotationTrait::notation","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/Logic.html","name":"Tailors\\Logic\\Logic","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Logic","fromLink":"Tailors/Logic/Logic.html","link":"Tailors/Logic/Logic.html#method___construct","name":"Tailors\\Logic\\Logic::__construct","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Logic","fromLink":"Tailors/Logic/Logic.html","link":"Tailors/Logic/Logic.html#method_var","name":"Tailors\\Logic\\Logic::var","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/LogicInterface.html","name":"Tailors\\Logic\\LogicInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\LogicInterface","fromLink":"Tailors/Logic/LogicInterface.html","link":"Tailors/Logic/LogicInterface.html#method_var","name":"Tailors\\Logic\\LogicInterface::var","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/AbstractPredicate.html","name":"Tailors\\Logic\\Predicates\\AbstractPredicate","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\AbstractPredicate","fromLink":"Tailors/Logic/Predicates/AbstractPredicate.html","link":"Tailors/Logic/Predicates/AbstractPredicate.html#method_apply","name":"Tailors\\Logic\\Predicates\\AbstractPredicate::apply","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\AbstractPredicate","fromLink":"Tailors/Logic/Predicates/AbstractPredicate.html","link":"Tailors/Logic/Predicates/AbstractPredicate.html#method_applyImpl","name":"Tailors\\Logic\\Predicates\\AbstractPredicate::applyImpl","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\AbstractPredicate","fromLink":"Tailors/Logic/Predicates/AbstractPredicate.html","link":"Tailors/Logic/Predicates/AbstractPredicate.html#method_validate","name":"Tailors\\Logic\\Predicates\\AbstractPredicate::validate","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/BasicPredicatesInterface.html","name":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface","fromLink":"Tailors/Logic/Predicates/BasicPredicatesInterface.html","link":"Tailors/Logic/Predicates/BasicPredicatesInterface.html#method_tee","name":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface::tee","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface","fromLink":"Tailors/Logic/Predicates/BasicPredicatesInterface.html","link":"Tailors/Logic/Predicates/BasicPredicatesInterface.html#method_falsum","name":"Tailors\\Logic\\Predicates\\BasicPredicatesInterface::falsum","doc":null},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/BasicPredicatesTrait.html","name":"Tailors\\Logic\\Predicates\\BasicPredicatesTrait","doc":"Example usage."},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\BasicPredicatesTrait","fromLink":"Tailors/Logic/Predicates/BasicPredicatesTrait.html","link":"Tailors/Logic/Predicates/BasicPredicatesTrait.html#method_tee","name":"Tailors\\Logic\\Predicates\\BasicPredicatesTrait::tee","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\BasicPredicatesTrait","fromLink":"Tailors/Logic/Predicates/BasicPredicatesTrait.html","link":"Tailors/Logic/Predicates/BasicPredicatesTrait.html#method_falsum","name":"Tailors\\Logic\\Predicates\\BasicPredicatesTrait::falsum","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\BasicPredicatesTrait","fromLink":"Tailors/Logic/Predicates/BasicPredicatesTrait.html","link":"Tailors/Logic/Predicates/BasicPredicatesTrait.html#method_makeBasicPredicates","name":"Tailors\\Logic\\Predicates\\BasicPredicatesTrait::makeBasicPredicates","doc":""},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/BinaryPredicateTrait.html","name":"Tailors\\Logic\\Predicates\\BinaryPredicateTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\BinaryPredicateTrait","fromLink":"Tailors/Logic/Predicates/BinaryPredicateTrait.html","link":"Tailors/Logic/Predicates/BinaryPredicateTrait.html#method_with","name":"Tailors\\Logic\\Predicates\\BinaryPredicateTrait::with","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\BinaryPredicateTrait","fromLink":"Tailors/Logic/Predicates/BinaryPredicateTrait.html","link":"Tailors/Logic/Predicates/BinaryPredicateTrait.html#method_arity","name":"Tailors\\Logic\\Predicates\\BinaryPredicateTrait::arity","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/Falsum.html","name":"Tailors\\Logic\\Predicates\\Falsum","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\Falsum","fromLink":"Tailors/Logic/Predicates/Falsum.html","link":"Tailors/Logic/Predicates/Falsum.html#method_apply","name":"Tailors\\Logic\\Predicates\\Falsum::apply","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\Falsum","fromLink":"Tailors/Logic/Predicates/Falsum.html","link":"Tailors/Logic/Predicates/Falsum.html#method_arity","name":"Tailors\\Logic\\Predicates\\Falsum::arity","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\Falsum","fromLink":"Tailors/Logic/Predicates/Falsum.html","link":"Tailors/Logic/Predicates/Falsum.html#method_symbol","name":"Tailors\\Logic\\Predicates\\Falsum::symbol","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\Falsum","fromLink":"Tailors/Logic/Predicates/Falsum.html","link":"Tailors/Logic/Predicates/Falsum.html#method_expressionString","name":"Tailors\\Logic\\Predicates\\Falsum::expressionString","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/PredicateFormula.html","name":"Tailors\\Logic\\Predicates\\PredicateFormula","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\PredicateFormula","fromLink":"Tailors/Logic/Predicates/PredicateFormula.html","link":"Tailors/Logic/Predicates/PredicateFormula.html#method___construct","name":"Tailors\\Logic\\Predicates\\PredicateFormula::__construct","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\PredicateFormula","fromLink":"Tailors/Logic/Predicates/PredicateFormula.html","link":"Tailors/Logic/Predicates/PredicateFormula.html#method_predicate","name":"Tailors\\Logic\\Predicates\\PredicateFormula::predicate","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/PredicateInterface.html","name":"Tailors\\Logic\\Predicates\\PredicateInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\PredicateInterface","fromLink":"Tailors/Logic/Predicates/PredicateInterface.html","link":"Tailors/Logic/Predicates/PredicateInterface.html#method_apply","name":"Tailors\\Logic\\Predicates\\PredicateInterface::apply","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/Tee.html","name":"Tailors\\Logic\\Predicates\\Tee","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\Tee","fromLink":"Tailors/Logic/Predicates/Tee.html","link":"Tailors/Logic/Predicates/Tee.html#method_apply","name":"Tailors\\Logic\\Predicates\\Tee::apply","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\Tee","fromLink":"Tailors/Logic/Predicates/Tee.html","link":"Tailors/Logic/Predicates/Tee.html#method_arity","name":"Tailors\\Logic\\Predicates\\Tee::arity","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\Tee","fromLink":"Tailors/Logic/Predicates/Tee.html","link":"Tailors/Logic/Predicates/Tee.html#method_symbol","name":"Tailors\\Logic\\Predicates\\Tee::symbol","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\Tee","fromLink":"Tailors/Logic/Predicates/Tee.html","link":"Tailors/Logic/Predicates/Tee.html#method_expressionString","name":"Tailors\\Logic\\Predicates\\Tee::expressionString","doc":null},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic\\Predicates","fromLink":"Tailors/Logic/Predicates.html","link":"Tailors/Logic/Predicates/UnaryPredicateTrait.html","name":"Tailors\\Logic\\Predicates\\UnaryPredicateTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\UnaryPredicateTrait","fromLink":"Tailors/Logic/Predicates/UnaryPredicateTrait.html","link":"Tailors/Logic/Predicates/UnaryPredicateTrait.html#method_with","name":"Tailors\\Logic\\Predicates\\UnaryPredicateTrait::with","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Predicates\\UnaryPredicateTrait","fromLink":"Tailors/Logic/Predicates/UnaryPredicateTrait.html","link":"Tailors/Logic/Predicates/UnaryPredicateTrait.html#method_arity","name":"Tailors\\Logic\\Predicates\\UnaryPredicateTrait::arity","doc":""},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/PrefixNotationTrait.html","name":"Tailors\\Logic\\PrefixNotationTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\PrefixNotationTrait","fromLink":"Tailors/Logic/PrefixNotationTrait.html","link":"Tailors/Logic/PrefixNotationTrait.html#method_notation","name":"Tailors\\Logic\\PrefixNotationTrait::notation","doc":""},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/SuffixNotationTrait.html","name":"Tailors\\Logic\\SuffixNotationTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\SuffixNotationTrait","fromLink":"Tailors/Logic/SuffixNotationTrait.html","link":"Tailors/Logic/SuffixNotationTrait.html#method_notation","name":"Tailors\\Logic\\SuffixNotationTrait::notation","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/SymbolInterface.html","name":"Tailors\\Logic\\SymbolInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\SymbolInterface","fromLink":"Tailors/Logic/SymbolInterface.html","link":"Tailors/Logic/SymbolInterface.html#method_symbol","name":"Tailors\\Logic\\SymbolInterface::symbol","doc":null},
            
                                                {"type":"Trait","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/SymbolNotationTrait.html","name":"Tailors\\Logic\\SymbolNotationTrait","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\SymbolNotationTrait","fromLink":"Tailors/Logic/SymbolNotationTrait.html","link":"Tailors/Logic/SymbolNotationTrait.html#method_notation","name":"Tailors\\Logic\\SymbolNotationTrait::notation","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/TermInterface.html","name":"Tailors\\Logic\\TermInterface","doc":""},
                
                                                {"type":"Class","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/AbstractArglistValidator.html","name":"Tailors\\Logic\\Validators\\AbstractArglistValidator","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Validators\\AbstractArglistValidator","fromLink":"Tailors/Logic/Validators/AbstractArglistValidator.html","link":"Tailors/Logic/Validators/AbstractArglistValidator.html#method_validate","name":"Tailors\\Logic\\Validators\\AbstractArglistValidator::validate","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\AbstractArglistValidator","fromLink":"Tailors/Logic/Validators/AbstractArglistValidator.html","link":"Tailors/Logic/Validators/AbstractArglistValidator.html#method_report","name":"Tailors\\Logic\\Validators\\AbstractArglistValidator::report","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\AbstractArglistValidator","fromLink":"Tailors/Logic/Validators/AbstractArglistValidator.html","link":"Tailors/Logic/Validators/AbstractArglistValidator.html#method_isValid","name":"Tailors\\Logic\\Validators\\AbstractArglistValidator::isValid","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\AbstractArglistValidator","fromLink":"Tailors/Logic/Validators/AbstractArglistValidator.html","link":"Tailors/Logic/Validators/AbstractArglistValidator.html#method_reportSingle","name":"Tailors\\Logic\\Validators\\AbstractArglistValidator::reportSingle","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\AbstractArglistValidator","fromLink":"Tailors/Logic/Validators/AbstractArglistValidator.html","link":"Tailors/Logic/Validators/AbstractArglistValidator.html#method_reportMultiple","name":"Tailors\\Logic\\Validators\\AbstractArglistValidator::reportMultiple","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\AbstractArglistValidator","fromLink":"Tailors/Logic/Validators/AbstractArglistValidator.html","link":"Tailors/Logic/Validators/AbstractArglistValidator.html#method_describeInvalidArguments","name":"Tailors\\Logic\\Validators\\AbstractArglistValidator::describeInvalidArguments","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/ArglistValidatorInterface.html","name":"Tailors\\Logic\\Validators\\ArglistValidatorInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Validators\\ArglistValidatorInterface","fromLink":"Tailors/Logic/Validators/ArglistValidatorInterface.html","link":"Tailors/Logic/Validators/ArglistValidatorInterface.html#method_validate","name":"Tailors\\Logic\\Validators\\ArglistValidatorInterface::validate","doc":""},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/BasicValidators.html","name":"Tailors\\Logic\\Validators\\BasicValidators","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Validators\\BasicValidators","fromLink":"Tailors/Logic/Validators/BasicValidators.html","link":"Tailors/Logic/Validators/BasicValidators.html#method___construct","name":"Tailors\\Logic\\Validators\\BasicValidators::__construct","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\BasicValidators","fromLink":"Tailors/Logic/Validators/BasicValidators.html","link":"Tailors/Logic/Validators/BasicValidators.html#method_comparatorArglist","name":"Tailors\\Logic\\Validators\\BasicValidators::comparatorArglist","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\BasicValidators","fromLink":"Tailors/Logic/Validators/BasicValidators.html","link":"Tailors/Logic/Validators/BasicValidators.html#method_numbersArglist","name":"Tailors\\Logic\\Validators\\BasicValidators::numbersArglist","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/BasicValidatorsInterface.html","name":"Tailors\\Logic\\Validators\\BasicValidatorsInterface","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Validators\\BasicValidatorsInterface","fromLink":"Tailors/Logic/Validators/BasicValidatorsInterface.html","link":"Tailors/Logic/Validators/BasicValidatorsInterface.html#method_comparatorArglist","name":"Tailors\\Logic\\Validators\\BasicValidatorsInterface::comparatorArglist","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\BasicValidatorsInterface","fromLink":"Tailors/Logic/Validators/BasicValidatorsInterface.html","link":"Tailors/Logic/Validators/BasicValidatorsInterface.html#method_numbersArglist","name":"Tailors\\Logic\\Validators\\BasicValidatorsInterface::numbersArglist","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/ComparatorArglistValidator.html","name":"Tailors\\Logic\\Validators\\ComparatorArglistValidator","doc":"Asserts that all the $arguments are numbers."},
                                {"type":"Method","fromName":"Tailors\\Logic\\Validators\\ComparatorArglistValidator","fromLink":"Tailors/Logic/Validators/ComparatorArglistValidator.html","link":"Tailors/Logic/Validators/ComparatorArglistValidator.html#method_isValid","name":"Tailors\\Logic\\Validators\\ComparatorArglistValidator::isValid","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\ComparatorArglistValidator","fromLink":"Tailors/Logic/Validators/ComparatorArglistValidator.html","link":"Tailors/Logic/Validators/ComparatorArglistValidator.html#method_describeInvalidArguments","name":"Tailors\\Logic\\Validators\\ComparatorArglistValidator::describeInvalidArguments","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/ComparatorArglistValidatorInterface.html","name":"Tailors\\Logic\\Validators\\ComparatorArglistValidatorInterface","doc":""},
                
                                                {"type":"Class","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/NumbersArglistValidator.html","name":"Tailors\\Logic\\Validators\\NumbersArglistValidator","doc":"Asserts that all the $arguments are numbers."},
                                {"type":"Method","fromName":"Tailors\\Logic\\Validators\\NumbersArglistValidator","fromLink":"Tailors/Logic/Validators/NumbersArglistValidator.html","link":"Tailors/Logic/Validators/NumbersArglistValidator.html#method_isValid","name":"Tailors\\Logic\\Validators\\NumbersArglistValidator::isValid","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Validators\\NumbersArglistValidator","fromLink":"Tailors/Logic/Validators/NumbersArglistValidator.html","link":"Tailors/Logic/Validators/NumbersArglistValidator.html#method_describeInvalidArguments","name":"Tailors\\Logic\\Validators\\NumbersArglistValidator::describeInvalidArguments","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic\\Validators","fromLink":"Tailors/Logic/Validators.html","link":"Tailors/Logic/Validators/NumbersArglistValidatorInterface.html","name":"Tailors\\Logic\\Validators\\NumbersArglistValidatorInterface","doc":""},
                
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/Variable.html","name":"Tailors\\Logic\\Variable","doc":""},
                                {"type":"Method","fromName":"Tailors\\Logic\\Variable","fromLink":"Tailors/Logic/Variable.html","link":"Tailors/Logic/Variable.html#method___construct","name":"Tailors\\Logic\\Variable::__construct","doc":""},
        {"type":"Method","fromName":"Tailors\\Logic\\Variable","fromLink":"Tailors/Logic/Variable.html","link":"Tailors/Logic/Variable.html#method_symbol","name":"Tailors\\Logic\\Variable::symbol","doc":null},
        {"type":"Method","fromName":"Tailors\\Logic\\Variable","fromLink":"Tailors/Logic/Variable.html","link":"Tailors/Logic/Variable.html#method_expressionString","name":"Tailors\\Logic\\Variable::expressionString","doc":null},
            
                                                {"type":"Class","fromName":"Tailors\\Logic","fromLink":"Tailors/Logic.html","link":"Tailors/Logic/VariableInterface.html","name":"Tailors\\Logic\\VariableInterface","doc":""},
                
                                // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Doctum = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Doctum.injectApiTree($('#api-tree'));
    });

    return root.Doctum;
})(window);

$(function() {

    
    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').on('click', function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Doctum.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


