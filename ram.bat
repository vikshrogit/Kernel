@echo off
setlocal enabledelayedexpansion

set argCount=0
for %%x in (%*) do (
   set /A argCount+=1
)

set p=''
if %argCount% LEQ 3 ( set p= %cd% )

php80 RAMPHP "%p%" %*

endlocal