//
//  CalculatorBrain.swift
//  demo_TP
//
//  Created by CNTT on 3/8/22.
//  Copyright © 2022 fit.tdc. All rights reserved.
//

import UIKit

func sign(_ a:Double)->Double {
    return -a
}
func add(_ a:Double,_ b:Double)->Double {
    return a + b
}
func sub(_ a:Double,_ b:Double)->Double {
    return a - b
}
func mul(_ a:Double,_ b:Double)->Double {
    return a * b
}
func div(_ a:Double,_ b:Double)->Double {
    return a / b
}

class CalculatorBrain {
    //MARK: Propeties
    private var accumlator:Double?
    
    struct PendingCalculation {
        let firstOperand:Double
        let function:(Double, Double)->Double
    }
    
    enum OperatorType {
        case constant(Double)
        case unaryOperator((Double)->Double)
        case binaryOperator((Double, Double)->Double)
        case equal
    }
    private let operators:[String:OperatorType] = [
    "e": .constant(M_E),
    "∏": .constant(Double.pi),
    "√": .unaryOperator(sqrt),
    "Cos": .unaryOperator(cos),
    "±": .unaryOperator(sign),
    "+": .binaryOperator(add),
    "-": .binaryOperator(sub),
    "*": .binaryOperator(mul),
    "÷": .binaryOperator(div),
    "=": .equal
    ]
    //MARK: class's Methods
    func setOperand(_ operand:Double) {
     accumlator = operand
    }
    
    var pendingCalculation:PendingCalculation?
    
    func performFunctions(_ mathSynbol:String) {
        if let operatorType = operators[mathSynbol]{
            switch operatorType {
            case .constant(let value):
                accumlator = value
            case .unaryOperator(let function):
                if let value = accumlator {
                    accumlator = function(value)
                }
            case .binaryOperator(let binaryFunction):
                if let value = accumlator {
                    pendingCalculation = PendingCalculation(firstOperand: value, function: binaryFunction)
                    accumlator = nil
                }
            case .equal:
                if let pendingCalculation = pendingCalculation {
                    if let value = accumlator {
                        accumlator = pendingCalculation.function(pendingCalculation.firstOperand,value)
                       self.pendingCalculation = nil
                    }
                }
            }
        }
        
    }
    
    public var result:Double?{
        get {
            return accumlator
        }
    }
}

