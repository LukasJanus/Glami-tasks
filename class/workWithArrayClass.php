<?php
        class workWithArray{
            /**
             * Počtem rozměrů pole
             * @var int 
             */
            private $dimensionNum = null;
            /**
             * Velikost pole
             * @var int
             */
            private $arraySize = null;
            /**
             * Vygenerované pole
             * @var array
             */
            private $array = null;
            /**
             * Defaultní hodnoty pro vytáření
             * @var int
             */
            private $defaultValue = 0;
            /**
             * Vygenerované pole zjednodušené do jednorozměrného pole
             * @var array
             */
            private $simplifiedArray = null;
            
            public function __construct($arraySize = null,$dimensionNum = null) {
                if(!is_null($arraySize)){
                    $this->setArraySize($arraySize);
                }else{
                    $this->setArraySize($this->defaultValue);
                }
                if(!is_null($dimensionNum)){
                    $this->setDimensionNum($dimensionNum);
                }else{
                    $this->setDimensionNum($this->defaultValue);
                }
            }
            /**
             * Nastavení počtu rozměrů pole
             * @param integer $dimensionNum Počet rozměrů pole
             * @return $this Vrací sebe pro řetězení příkazu.
             * @throws Exception Výjímka zadávání rozměru.
             */
            public function setDimensionNum(int $dimensionNum):self{
                try{
                    if(!$dimensionNum){
                        throw new Exception('Dimension number can´t be 0.');
                    }
                    if(is_null($dimensionNum)){
                        throw new Exception('Please set a number of dimensions.');
                    }
                    if(!is_numeric($dimensionNum)){
                        throw new Exception('Number of dimensions must be a number (integer).');
                    }
                    $this->dimensionNum = $dimensionNum;
                } catch (Exception $e){
                    echo '<div class="alert alert-warning m-2" role="alert">Caught exception: '.$e->getMessage().'</div>';
                }
                return $this;
            }
            /**
             * Getter pro získání rozměrů pole.
             * @return int Vrací počet rozměrů pole.
             */
            public function getDimensionNum():int{
                return $this->dimensionNum;
            }
            public function setArraySize(int $arraySize):self{
                try{
                    if(!$arraySize){
                        throw new Exception('Array size can´t be 0.');
                    }
                    if(is_null($arraySize)){
                        throw new Exception('Please set a size of array.');
                    }
                    if(!is_numeric($arraySize)){
                        throw new Exception('Size of array must be a number (integer).');
                    }
                    $this->arraySize = $arraySize;
                } catch (Exception $e){
                    echo '<div class="alert alert-warning m-2" role="alert">Caught exception: '.$e->getMessage().'</div>';
                }
                return $this;
            }
            /**
             * Getter pro získání velikosti pole.
             * @return int Vrací velikost pole.
             */
            public function getArraySize():int{
                return $this->arraySize;
            }
            /**
             * Spuštění generování pole.
             * @return $this Vrací sebe pro řetězení příkazu.
             */
            public function setArray():self{
                if($this->arraySize <= 0 || $this->dimensionNum <= 0){
                    $this->array = [];
                }else{
                    $this->array = $this->generateArray($this->arraySize, $this->dimensionNum);
                }
                return $this;
            }
            /**
             * Getter pro získání generovaného pole
             * @return array Generovaného pole
             */
            public function getArray():array{
                return $this->array;
            }
            /**
             * Metoda pro zavolání zjednodušení pole uživatelem
             * @return \self Vrací sebe pro řetězení příkazu.
             */
            public function setSimplifiedArray():self{
                $this->simplifiedArray = $this->simplifyArray([], $this->array);
                return $this;
            }
            /**
             * Getter pro získání zjednodušeného pole
             * @return array Zjednodušné pole
             */
            public function getSimplifiedArray():array{
                return $this->simplifiedArray;
            }
            /**
             * Metoda pro nalezení minimální hodnoty v jednoduchém poli
             * @return int Minimální hodnota v poli
             * @throws Exception Pokud nebylo vytvořeno zjednodušené pole
             */
            public function getMinVal():int{
                try{
                    if(is_null($this->simplifiedArray)){
                        throw new Exception('Please simplify array first!.');
                    }
                    return min($this->simplifiedArray);
                }catch(Exception $e){
                    echo '<div class="alert alert-warning m-2" role="alert">Caught exception: '.$e->getMessage().'</div>';
                }
            }
            /**
             * Metoda pro nalezení minimální hodnoty v jednoduchém poli
             * @return int Minimální hodnota v poli
             * @throws Exception Pokud nebylo vytvořeno zjednodušené pole
             */
            public function getMaxVal():int{
                try{
                    if(is_null($this->simplifiedArray)){
                        throw new Exception('Please simplify array first!.');
                    }
                    return max($this->simplifiedArray);
                }catch(Exception $e){
                    echo '<div class="alert alert-warning m-2" role="alert">Caught exception: '.$e->getMessage().'</div>';
                }
            }
            /**
             * Rekurzivní funkce pro generování více rozměrného pole plněného náhodným číslem
             * @param int $num Velikost pole
             * @param int $dim Počet rozměrů které zbívají pro generování.
             * @return array Výsledné pole
             */
            private function generateArray(int $num,int $dim):array{
            //Dekrementace počtu rozměrů aby se při rekurzy vytvořil zadaný počet
            $dim--;
            $return = [];
                for($i = 0; $i < $num; $i++){
                    //Rekurze
                    $return[$i] = ($dim === 0)?rand(): $this->generateArray($num,$dim);
                }
            return $return;
            }
            /**
             * Metoda která z více rozměrného pole vytvoří jednoduché jednorozměrné pole
             * @param array $arrayIn Vstupní pole, které bude plněno
             * @param array $arrayOut Původní pole, které se bude procházet pro zjednodušení
             * @return array
             */
            private function simplifyArray(array $arrayIn, array $arrayOut):array{
                try{
                    if(is_null($this->array)){
                        throw new Exception('Please generate array first!');
                    }
                    foreach($arrayOut as $value){
                        if(is_iterable($value)){
                            $arrayIn = $this->simplifyArray($arrayIn, $value);
                        }else{
                            $arrayIn[] = $value; 
                        }
                    }
                    return $arrayIn;
                }catch(Exception $e){
                    echo '<div class="alert alert-warning m-2" role="alert">Caught exception: '.$e->getMessage().'</div>';
                }
            
        }   
        }
 