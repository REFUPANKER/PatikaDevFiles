public class FastCommands
{
    ///<summary>
    /// Console Write Static
    ///</summary>
    public static void cws(object msg)
    {
        System.Console.Write(msg);
    }
    ///<summary>
    /// Console Write Line Static
    ///</summary>
    public static void cwls(object msg)
    {
        System.Console.WriteLine(msg);
    }
    public void cw(object msg)
    {
        System.Console.Write(msg);
    }
    public void cwl(object msg)
    {
        System.Console.WriteLine(msg);
    }

    public string[] ReadLines(int length)
    {
        string[] res = new string[length];
        for (int i = 0; i < length; i++)
        {
            res[i] = Console.ReadLine() + "";
        }
        return res;
    }
    public string? ReadLine(string inputCursor=">")
    {
        cw(inputCursor);
        return Console.ReadLine();
    }
    ConsoleColor precolor;
    public void TaskRunningNotify(string name)
    {
        precolor = Console.ForegroundColor;
        Console.ForegroundColor = ConsoleColor.Yellow;
        cwl("[!]Task running : " + name);
        Console.ForegroundColor = precolor;
    }
    public void WriteLineColorized(ConsoleColor color, object msg)
    {
        precolor = Console.ForegroundColor;
        Console.ForegroundColor = color;
        System.Console.WriteLine(msg);
        Console.ForegroundColor = precolor;
    }
    public void WriteColorized(ConsoleColor color, object msg)
    {
        precolor = Console.ForegroundColor;
        Console.ForegroundColor = color;
        System.Console.Write(msg);
        Console.ForegroundColor = precolor;
    }

    public int? CanConvertStringToInt(string msg)
    {
        try
        {
            return Convert.ToInt32(msg);
        }
        catch
        {
            return null;
        }
    }
}