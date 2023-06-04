class Task5 : FastCommands, TaskTheme
{
    public void Run()
    {
        int? target = null;
        while (target == null)
        {
            Console.Clear();
            WriteLineColorized(ConsoleColor.Cyan, "Fibonacci nums average calculater");
            WriteLineColorized(ConsoleColor.Yellow, "[!]Type negative number to exit");
            WriteColorized(ConsoleColor.Green, "Length :");
            target = CanConvertStringToInt(ReadLine(""));
            if (target <= 1)
            {
                target = null;
                break;
            }
        }
        if (target == null)
        {
            return;
        }
        string NumStr = "[1,1,";
        int sum = 2, pre = 1, next = 1;
        for (int i = 0; i < target - 1; i++)
        {
            next = pre + next;
            pre = next - pre;
            NumStr += next + ((i + 1 < target - 1) ? "," : "]");
            sum += next;
        }
        NumStr = (target <= 1) ? "[1,1]" : NumStr;
        WriteLineColorized(ConsoleColor.White, "Nums :" + NumStr + "\nSummary :" + sum + " | Length :" + target);
        WriteLineColorized(ConsoleColor.Cyan, $"Result > {sum}/{target} =" + ((float)sum / (float)target));
    }
}