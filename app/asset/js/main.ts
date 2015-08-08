///<reference path='../../../vendor/metrica/hikari-js/import.ts'/>

module MyNamespace
{
    import ClassOne = Hikari.ClassOne;
    import ClassTwo = Hikari.ClassTwo;

    export class Main
    {
        private _classOne:ClassOne;
        private _classTwo:ClassTwo;

        constructor()
        {
            this._classOne = new ClassOne();
            this._classTwo = new ClassTwo();
        }
    }
}